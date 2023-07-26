<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
            // Fetching assignments and grouping them by requesttype
              $assignmentsByRequestType = Assignment::select('request_type', DB::raw('count(*) as count'))
              ->groupBy('request_type')
              ->get();

          // Converting the data to a format suitable for the chart
          $data = [];
          foreach ($assignmentsByRequestType as $assignment) {
              $data[] = [
                  'label' => $assignment->requesttype,
                  'count' => $assignment->count,
              ];
          }
      
      
           // Getting the currently logged-in user
           $user = Auth::user();
      
           $assignmentsInProgress = Assignment::whereHas('users', function ($query) use ($user) {
            $query->where('users_id', $user->id);
        })->where('status', 'in progress')
        ->get();

           // Counting the number of assignments for each request type
           $requestTypes = $assignmentsInProgress->groupBy('request_type')->map->count();

           // Preparing the data for the graph
        $requestTypeLabels = ['domain', 'BPR', 'website']; 
        $requestTypesWithZeroCount = [];

        foreach ($requestTypeLabels as $label) {
            if ($requestTypes->has($label)) {
                $requestTypesWithZeroCount[$label] = $requestTypes[$label];
            } else {
                $requestTypesWithZeroCount[$label] = 0;
            }
        }

        $xAxis = json_encode(array_keys($requestTypesWithZeroCount)); 
        $yAxis = json_encode(array_values($requestTypesWithZeroCount));

        
        return view('dashboard.index', compact('assignmentsByRequestType', 'user', 'requestTypes'
        ,'data','assignmentsInProgress','requestTypeLabels','requestTypesWithZeroCount', 'xAxis', 'yAxis'));
    }

    public function compactTables()
    {
    // Retrieve assignments data from your database or any other source
    $assignments = Assignment::all(); // Replace Assignment with your actual model class

    return view('pages.tables', compact('assignments'));
    }
}
