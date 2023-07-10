<?
namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GraphController extends AdminBaseController
{

    public function memberActivity()
    {
        $assignments = Assignment::whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->select('user_id', 'start_date', 'end_date')
            ->get();

        $data = [];

        foreach ($assignments as $assignment) {
            $duration = Carbon::parse($assignment->start_date)->diffInDays($assignment->end_date);
            $data[$assignment->user_id][] = $duration;
        }

        $chartData = [];
        foreach ($data as $userId => $durations) {
            $chartData[] = [
                'label' => "User ID: $userId",
                'data' => $durations,
            ];
        }

        return view('admin.member_activity', compact('chartData'));
    }
}