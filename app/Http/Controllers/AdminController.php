<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use AuthenticatesAdmins;
use Spatie\Activitylog\Models\Activity;
use App\Models\Assignment;


class AdminController extends AdminBaseController {

    public function login(){

        return view('admin.admin_login');
    }

    public function store(Request $request){
        //validate login data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the admin credentials
        if (Auth::guard('admin')->attempt($validatedData)) {
            // Get the authenticated admin
            // $admin = Auth::guard('admin')->user();
            // // Store the admin's ID in the session
            // Auth::guard('admin')->loginUsingId($admin->id);

            // // Log the admin login activity
            // activity()
            //     ->performedOn($admin)
            //     ->causedBy($admin)
            //     ->log('Admin Login');

            // // Redirect to the admin dashboard or any other desired page
            return redirect() -> route('admin.dashboard');
            //return ('SIGN IN SUCCESS');
        }

        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);

    }

    public function dashboard(){

        $assignedCount = Assignment::where('status', 'Assigned')->count();
        $notAssignedCount = Assignment::where('status', 'Unassigned')->count();
        $inProgressCount = Assignment::where('status', 'In Progress')->count();
        $completedCount = Assignment::where('status', 'Completed')->count();

        return view('admin.adminDashboard', compact('assignedCount', 'notAssignedCount', 'inProgressCount', 'completedCount'));
    }

    public function create()
    {
        return view('admin.adminProfile');
    }

    public function update()
    {
            
        $admin = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'name' => 'required',
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    
}
}