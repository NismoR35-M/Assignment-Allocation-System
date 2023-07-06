<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

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
    ]);

    // Create a new Assignment instance
    $assignment = new Assignment();

    // Assign form data to the Assignment instance
    $assignment->name = $request->input('name');
    $assignment->company_name = $request->input('company_name');
    $assignment->request_type = $request->input('request_type');
    $assignment->description = $request->input('description');
    $assignment->start_date = $request->input('datereceived'); // Update to 'datereceived' instead of 'start_date'
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

    // Retrieve the selected user IDs
    $userIds = $request->input('user');
    
    // Attach the users to the assignment in the junction table
    $assignment->users()->attach($userIds);

    // Redirect or perform any other actions after saving the assignment
    return redirect()->back()->with('success', 'Assignment saved successfully!');
}

}
