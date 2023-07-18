<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function compactTables()
{
    // Retrieve assignments data from your database or any other source
    $assignments = Assignment::all(); // Replace Assignment with your actual model class

    return view('pages.tables', compact('assignments'));
}

}
