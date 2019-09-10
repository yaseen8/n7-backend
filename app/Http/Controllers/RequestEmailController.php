<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppRequestEmailModel\RequestEmail;
use Mail;

class RequestEmailController extends Controller
{
    protected $model;
    public function __construct(RequestEmail $model)
    {
        $this->model=$model;
       $this->middleware('auth',['except'=>['get_requested_email']]);
    }

    public function invitation_email_list(Request $request)
    {
        $list = RequestEmail::paginate(25);
        return response()->json($list, 200);
    }

    public function get_requested_email(Request $request)
    {
        $email = $request->input('email');
        $check_mail = RequestEmail::where('email' , $email)->get();
        if($check_mail) {
            return response()->json($check_mail, 200);
        }
        return response()->json('not found',404);
    }

    public function send_invitation(Request $request)
    {
        $email = RequestEmail::create($request->all());
        if($email) {
            Mail::send(['text' => 'mail'], ['name' => 'n7Group' ], function ($m) use ($email) {
                $m->from('emailtoyaseen@gmail.com', 'n7Group');
    
                $m->to($email->email)->subject('Invitation');
            });
        }
        return response()->json($email, 200);
    }

    public function resend_mail(Request $request)
    {
        $email = $request->input('email');
        Mail::send(['text' => 'mail'], ['name' => 'n7Group' ], function ($m) use ($email) {
            $m->from('emailtoyaseen@gmail.com', 'n7Group');

            $m->to($email)->subject('Invitation');
        return response()->json($email, 200);
        });
    }
}
