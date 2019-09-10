<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppJobDetailModel\JobDetail;


class JobDetailController extends Controller
{
    protected $model;
    public function __construct(JobDetail $model)
    {
       $this->model=$model;
       $this->middleware('auth');
    }

    public function get_job_detail(Request $request)
    {
        $detail = JobDetail::where('fk_user_id',  $request->user()->id)->first();
        if($detail) {
            return response()->json($detail, 200);
        }
       return response()->json('Not found', 404);
    }

}
