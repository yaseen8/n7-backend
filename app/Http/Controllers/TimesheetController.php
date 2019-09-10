<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppTimesheetModel\TimeSheet;
use Carbon\Carbon;

class TimesheetController extends Controller
{
    protected $model;
    public function __construct(TimeSheet $model)
    {
       $this->model=$model;
       $this->middleware('auth');
    }

    public function attendence_list()
    {
        $list = TimeSheet::with('user')
                ->orderBy('check_in', 'desc')
                ->paginate(25);
        return response()->json($list);
    }

    public function get_check_in_detail(Request $request)
    {
        $date = $request->input('date');
        $detail = TimeSheet::whereDate('check_in', '=' , $date)->first();
        if($detail) {
            return response()->json($detail, 200);
        }
        return response()->json('Not found', 404);
    }

    public function check_in_user(Request $request)
    {
        $check_in = TimeSheet::create(
            [
                'check_in_location' => $request->input('check_in_location'),
                'fk_user_id' => $request->user()->id
            ]
            );
        if($check_in) {
            return response()->json($check_in, 200);
        }
        return response()->json('Went wrong', 400);
    }

    public function check_out_user(Request $request)
    {
        $check_out = TimeSheet::whereDate('check_in', '=', $request->input('checkin_date'))
                                ->whereNull('check_out')
                                ->where('fk_user_id', $request->user()->id)
                                ->first();
        if($check_out) {
            $check_out->update(
                [
                    'check_out' => \Carbon\Carbon::now('+5 hours'),
                    'check_out_location' => $request->input('check_out_location')
                ]
                );
        return response()->json($check_out, 200);
        }
        return response()->json('Not found', 404);
    }
    
    public function get_attendence_record(Request $request)
    {
        $record = TimeSheet::where('fk_user_id', $request->user()->id)->get();
        return response()->json($record, 200);
    }
}
