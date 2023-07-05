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

        return view('components.pages.tables', compact('assignments', 'assignment_Count'));
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
}