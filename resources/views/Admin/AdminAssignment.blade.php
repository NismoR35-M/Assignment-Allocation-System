<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{

    public function index()
    {
        $assignments = Assignment::all(); 

        return view('admin.assignments', compact('assignments'));
    }

    public function show(string $id)
    {
        $assignment = Assignment::findorFail($id);

        return view('admin.assignment_show', compact('assignment'));
    }

        public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('request_file')) {
            $file = $request->file('request_file');
            $path = $file->store('public/files');
            $assignment->request = $path;
        }

        // Save other assignment details
        // ...

        $assignment->save();

        // Redirect or perform additional actions as needed
    }

}