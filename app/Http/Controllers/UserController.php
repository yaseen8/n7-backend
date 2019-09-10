<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUserModel\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
       $this->middleware('auth');
        $this->user =  Auth::user();

    }

    public function user_list(Request $request)
    {
        $user = User::where('user_type', 'user')->paginate(25);
        return response()->json($user, 200);
    }

    public function loggedInUser()
    {
        return response()->json(auth()->user(), 200);
    }

    public function get_user_profile(Request $request)
    {
        $profile = User::where('id', $request->user()->id)
                        ->first();
        if($profile) {
            return response()->json($profile, 200);
        }
    }
}
