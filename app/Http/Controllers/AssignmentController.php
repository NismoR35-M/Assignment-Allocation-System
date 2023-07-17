<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use App\Notifications\Assignment_Assigned;
use Illuminate\Support\Facades\Notification;

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

    public function assign(Request $request)
{
    $assignment = Assignment::findOrFail($request->input('assignment_id'));
    $userIds = $request->input('users');
    $users = User::whereIn('id', $userIds)->get();

    $assignment->users()->attach($users);

    // Send the notification to the assigned members
    Notification::send($users, new Assignment_Assigned($assignment));

    return redirect()->back()->with('status', 'Assignment assigned successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}