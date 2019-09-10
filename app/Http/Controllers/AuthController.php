<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Models\AppUserModel\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
       /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        // $this->middleware('auth',['except'=>['login']]);

    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);


        try {
            if (! $token = $this->jwt->attempt($request->only('email','password'))) {

                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }

    public function admin_login(Request $request)
    {

        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
            'user_type' => 'required',
        ]);


        try {
            if (! $token = $this->jwt->attempt($request->only('email','password', 'user_type'))) {

                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token=$this->jwt->getToken();
        $this->jwt->invalidate($token);
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}


