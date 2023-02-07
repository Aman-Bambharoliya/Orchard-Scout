<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin;
// use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Models\Customer;
use Hash;

class LoginController extends BaseController
{
    
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (isset($request->email) && !is_numeric($request->email)) {
            $cond='email';
        } else {
            $cond='';
        }
        $validator =  Validator::make($request->all(), [
            'email' => 'required|'.$cond.'',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
            $user = Admin::where("email", request('email'))->first();
        if (!isset($user)) {
            return $this->sendError(trans('translation.not_found', ['name' => 'User']), ['status'=>-1]);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return $this->sendError(trans('translation.password_wrong'), ['status'=>-1]);
        }
        return $this->generateToken($user); 
    }
    public function generateToken($user)
    {
        $tokenResult = $user->createToken('orchard_scout');
        $user->access_token = $tokenResult->accessToken;
        $user->token_type = 'Bearer';
        return response()->json([
            'success' => true,
            'status' => 1,
            'data' => $user,
            'message' => trans('translation.user_login_success'),
        ]);
    }
}
