<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255|min:6|confirmed'
        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()],422);
        }

        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->get('email');
        $user->password = bcrypt( $request->get('password'));
        $user->save();

        return $this->getResponse($user);

    }

    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255|min:6'
        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()],422);
        }

        $success = Auth::attempt(['email' => $request->get('email'),'password' => $request->password]);

        if($success){
            $user = $request->user();

          return $this->getResponse($user);
           
        }

    }

    public function getResponse(User $user){
        $tokennResult = $user->createToken("Personal Token");
        $token = $tokennResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response([
            'accessToken' => $tokennResult->accessToken,
            'tokenType' => 'Bearer',
            'expiresAt' => Carbon::parse($token->expires_at)->toDateTimeString()
        ],200);
    }

    public function user(Request $request){
        return $request->user();
    }

    public function logout(Request $request){
        return $request->user()->token()->revoke();
    }

    public function authFailed(){
        return response('Unauthorized', 401);
    }
}
