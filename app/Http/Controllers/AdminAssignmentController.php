<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAssignmentController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.assign_assignments', compact('users'));
    }

    public function shows()
    {
        $assignments = Assignment::all(); // Replace `Assignment` with your actual model name


        return view('admin.Assignments', compact('assignments'));
    }

    public function show_users()
    {

        $users = User::all();
        return view('admin.members', compact('users'));
    }

    // public function assign(Request $request)
    // {
    //     $assignment = Assignment::findOrFail($request->input('assignment_id'));
    //     $userIds = $request->input('users');
    //     $users = User::whereIn('id', $userIds)->get();

    //     $assignment->users()->attach($users);

    //     return redirect()->back()->with('status', 'Assignment assigned successfully.');
    // }

        public function assignAssignment(Request $request)
    {
        dd($request->all());
        // Validate the form data
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
       
        dd($validatedData);

    // Create a new Assignment instance
    $assignment = new Assignment();

        // Assign form data to the Assignment instance
        $assignment->name = $request->input('name');
        $assignment->company_name = $request->input('company_name');
        $assignment->request_type = $request->input('request_type');
        $assignment->description = $request->input('description');
        $assignment->start_date = $request->input('start_date');
        $assignment->status = $request->input('status');
        $assignment->response = $request->input('response');

    // Upload and store the response file, if provided
    if ($request->hasFile('response_file')) {
        $file = $request->file('response_file');
        $path = $file->store('response_files', 'public');
        $assignment->response_file = $path;
    }

        // Save the Assignment instance to the database
        $assignment->save();
        // $assignment->users()->sync($validatedData['user']);
        // Assign users to the assignment
        // $userIds = $validatedData['users'];
        // $assignment->users()->attach($userIds);

        // Redirect or perform any other actions after saving the assignment
        return redirect()->route('show_assignments')->with('success', 'Assignment saved successfully!');
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

}
