<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use AuthenticatesAdmins;
use Spatie\Activitylog\Models\Activity;
use App\Models\Assignment;
use App\Models\User;


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




        // Fetchiing assignments and grouping them by requesttype
        $assignmentsByRequestType = Assignment::select('request_type', DB::raw('count(*) as count'))
        ->groupBy('request_type')
        ->get();

    // Converting  the data to a format suitable for the chart
    $data = [];
    foreach ($assignmentsByRequestType as $assignment) {
        $data[] = [
            'label' => $assignment->request_type,
            'count' => $assignment->count,
        ];
    }

     // Fetching all users and their assigned tasks count with status = "In Progress"
     $users = User::withCount(['assignments' => function ($query) {
      $query->where('status', 'In Progress');
    }])->get();

    // Preparing the data for the chart
    $userNames = $users->pluck('first_name')->toArray();
    $taskCounts = $users->pluck('assignments_count')->toArray();




     // Fetching the number of completed tasks for each request type
     $requestTypes = Assignment::select('request_type')
     ->where('status', 'Completed')
     ->groupBy('request_type')
     ->get();

    $requestTypeLabels = $requestTypes->pluck('request_type')->toArray();
    $completedTaskCounts = [];

    foreach ($requestTypes as $requestType) {
     $completedTaskCounts[] = Assignment::where('request_type', $requestType->request_type)
         ->where('status', 'Completed')
         ->count();
    }

        return view('admin.adminDashboard', compact('assignedCount', 'notAssignedCount', 'inProgressCount'
        ,'data','userNames','taskCounts','requestTypeLabels','completedTaskCounts','completedCount'));
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