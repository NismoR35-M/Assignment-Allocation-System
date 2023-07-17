<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments =Assignment::orderBy('created_at', 'desc')->get();
        $assignment_Count = Assignment::count();

        return view('pages.tables', compact('assignments', 'assignment_Count'));
    }

    
    public function show(string $id)
    {
        $assignment = Assignment::findorFail($id);
        $users = $assignment->users;

        return view('assignment_show', compact('assignment', 'users'));
    }

    public function update(Request $request, $id)
   {
    $request->validate([
        'status' => 'required' 
    ]);

    $assignment = Assignment::findOrFail($id);
    $assignment->status = $request->input('status');
    $assignment->save();

      return redirect()->back()->with('success', 'Status updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //////////////////////////////// HANDLING MESSAGING /////////////////////////////////////////
    
    //return view where user can write the message
    public function createMessage($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $id = $assignment->id;
    
        return view('admin.messaging', compact('assignment', 'id'));
    }
    


    // Creating and storing message by User
    public function storeMessage(Request $request, $assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        // Validate the message content
        $validatedData = $request->validate([
            'response' => 'required|string',
        ]);

        // Create a new message instance
        $message = $validatedData['response'];
        $assignment->response = $message;
        $assignment->is_admin_reply = false;
        $assignment->is_read = false;
        $assignment->save();

        // Update the latest_message_id field
        $assignment->latest_message_id = $assignment->id;
        $assignment->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // Reply from admin
    public function replyMessage(Request $request, $assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        // Validate the message content
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        // Create a new message instance
        $message = $validatedData['message'];
        $assignment->response = $message;
        $assignment->is_admin_reply = true;
        $assignment->is_read = false;
        $assignment->save();

        // Update the latest_message_id field
        $assignment->latest_message_id = $assignment->id;
        $assignment->save();

        // Redirect back or perform any other actions after storing the message
        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    // Fetch user messages for admin
    public function getUserMessages($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $userMessages = $assignment->messages()->where('is_admin_reply', false)->get();

        return view('assignments.user_messages', compact('assignment', 'userMessages'));
    }

    // Fetch admin messages for user
    public function getAdminMessages($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $adminMessages = $assignment->messages()->where('is_admin_reply', true)->get();

        return view('assignments.admin_messages', compact('assignment', 'adminMessages'));
    }

}