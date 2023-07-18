<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminAssignmentController extends Controller
{
    
    public function index()
    {

        // Retrieve the authenticated user
        $user = Auth::user();

    // Get the assignments assigned to the user
       $assignments = $user->assignments;
       $assignments = Assignment::orderBy('created_at', 'desc')->get();

        return view('pages.tables', compact('assignments'));
    }   
    public function adminIndex()
    {
        $assignments = Assignment::orderBy('created_at', 'desc')->get();
        $assignment_Count = Assignment::count();

        return view('pages.admin_assignments', compact('assignments', 'assignment_Count'));
    }

    /////////////////////////////////////////ASSIGN ASSIGNMENT ///////////////////////////////////////////
    public function create()
    {
        $users = User::all();
        return view('admin.assign_assignments', compact('users'));
    }


    public function assign(Request $request)
    {
        $assignment = Assignment::findOrFail($request->input('assignment_id'));
        $userIds = $request->input('users');
        $users = User::whereIn('id', $userIds)->get();

        $assignment->users()->attach($users);

        return redirect()->back()->with('status', 'Assignment assigned successfully.');
    }


    public function assignAssignment(Request $request)
    {
        //dd($request->all());
        //Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'request_type' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'response' => 'nullable',
            'response_file' => 'nullable|file',
            'users' => 'required|array', // Assuming the input name for users is 'users'
        ]);
       
       
        $path = null;
        // // Upload and store the response file, if provided
        if ($request->hasFile('response_file')) {
            $file = $request->file('response_file');
            $path = $request->store('response_files', 'public');
        
        }

        // Save the assignment in the database
        $assignment = new Assignment();

        $assignment->company_name = $request->company_name;
        $assignment->request_type = $request->request_type;
        $assignment->description = $request->description;
        $assignment->start_date = $request->start_date;
        $assignment->status = $request->status;
        $assignment->file_type = $request->getClientOriginalExtension();
        $assignment->response = $path;
        $assignment->save();

            ////////// INITIAL CODE //////
    //      $assignment->users()->sync($validatedData['user']);
    //     // Assign users to the assignment
    //     $userIds = $validatedData['users'];
    //     $assignment->users()->attach($userIds);

    // Attach members if the status is "Assigned"
    if ($request->status === 'Assigned' && $request->has('members_assigned')) {
        $membersAssigned = $request->members_assigned;
        $assignment->users()->attach($membersAssigned);
    }

    // Check if the authenticated user is using the 'admin' guard
    if (auth()->guard('admin')->check()) {
        // If the user is an admin, redirect to the admin assignment view
        return redirect()->route('admin_assignments')->with('status', 'Assignment added successfully.');
    } else {
        // If the user is not an admin, redirect to the tables view
        return redirect()->route('show_assignments')->with('status', 'Assignment added successfully.');
    }
    }

/////////////////////////// ACTIONS ///////////////////////////////////////////////////////
    
    public function userAssignments(string $id)
    {
        $assignment = Assignment::findOrFail($id);
    
        return view('assignment.user_assignments', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $users = User::all();
        return view('assignment.assignment_edit_button', compact('assignment','users'));
    }

    public function showAssign(string $id)
    {
        $assignment = Assignment::findOrFail($id);
    
        return view('assignment.assignment_view', compact('assignment'));
    }


    public function showAssignments()
    {
        $assignments = Assignment::all(); // Replace `Assignment` with your actual model name


        return view('admin.Assignments', compact('assignments'));
    }

    public function show_users()
    {

        $users = User::all();
        return view('admin.members', compact('users'));
    }

    public function viewAssignment(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        return view("assignment.assignment_view", compact(['assignment']));
    }

        public function view2()
    {
        $id = 1; // Replace with the actual assignment ID
        return $this->viewMemberAssignments($id);
    }


    public function viewMemberAssignments($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view("user_assignments", compact(['assignment']));
    }

    public function assignUpdate(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required',
            'request_type' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'members_assigned' => 'required|array',
            'new_attachment' => 'nullable|file'
        ]);
    
        $assignment = Assignment::findOrFail($id);
        $assignment->company_name = $request->input('company_name');
        $assignment->request_type = $request->input('request_type');
        $assignment->description = $request->input('description');
        $assignment->start_date_request_received = $request->input('start_date');
        $assignment->status = $request->input('status');
    
        // Check if the remove attachment option is selected
        if ($request->has('remove_attachment')) {
            // Remove the current attachment
            if ($assignment->request) {
                Storage::disk('public')->delete($assignment->request);
                $assignment->request = null;
            }
        }
    
        // Handle attachment update
        if ($request->hasFile('new_attachment')) {
            // Remove the current attachment (optional)
            if ($assignment->request) {
                Storage::disk('public')->delete($assignment->request);
            }
    
            // Upload and store the new attachment
            $newAttachment = $request->file('new_attachment');
            $newAttachmentPath = $newAttachment->store('requests', 'public');
            $assignment->request = $newAttachmentPath;
        }
    
        // Update members assigned
        $membersAssigned = $request->input('members_assigned');
        $assignment->users()->sync($membersAssigned);

        if (count($membersAssigned) > 0) {
           $assignment->status = 'Assigned';
       } else {
           $assignment->status = 'Unassigned';
       }
    
        $assignment->save();
    
        return redirect()->route('view_assignment', $assignment->id)->with('status', 'Assignment updated successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:In Progress,Completed'
        ]);
    
        $assignment = Assignment::findOrFail($id);
    
       //  // Check if the assignment is in the correct status flow
       //  if ($assignment->status === 'Assigned' && ($request->input('status') === 'In Progress' || $request->input('status') === 'Completed')) {
            $assignment->status = $request->input('status');
            $assignment->save();
    
            return redirect()->back()->with('status', 'Status updated successfully.');
       //  }
    
        // Invalid status update attempted
        //return redirect()->back()->withErrors(['status' => 'Invalid status update attempted.']);
    }
    


        public function deleteAttachment(Request $request, $id)
    {
          $assignment = Assignment::findOrFail($id);

      if ($assignment->request) {
       // Delete the attachment file
       Storage::disk('public')->delete($assignment->request);

       // Remove the attachment reference from the assignment
       $assignment->request = null;
       $assignment->save();

       return redirect()->route('assignment_edit', $assignment->id)->with('status', 'Attachment deleted successfully.');
      }

   return redirect()->route('assignEdit', $assignment->id)->with('status', 'No attachment found.');
}


public function createForm()
{
    return view('admin.addUser');
}
    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'staff_number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->staff_number = $validatedData['staff_number'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    
        // Redirect to the appropriate page or show a success message
        return redirect()->route('show_users')->with('success', 'User created successfully');
    }

    public function deleteUser($id)
    {
        // Find the school record by ID
        $user = User::findOrFail($id);

            // Attempt to delete the school record
        if ($user->delete()) {
            return redirect()->back()->with('success', 'Student record deleted successfully!!!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Student record!!!');
        }
    }

       public function assigned(){

       $assignedAssignments = Assignment::where('status', 'Assigned')->get();

       return view('assignment.assigned', compact('assignedAssignments'));
       }

       public function unassigned(){

        $unassignedAssignments = Assignment::where('status','Unassigned')->get();
        return view('assignment.unassigned',compact('unassignedAssignments'));
       }

}
