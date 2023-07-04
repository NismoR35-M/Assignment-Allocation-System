<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use AuthenticatesAdmins;
use Spatie\Activitylog\Models\Activity;


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
            return redirect() -> route('dashboard');
            //return ('SIGN IN SUCCESS');
        }

        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);

    }
}