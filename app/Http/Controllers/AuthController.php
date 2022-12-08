<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;

class AuthController extends Controller
{

    public function register(UserRegisterRequest $request)
    {

        $user = User::query()->create([
            'name' => $request->name,
            'family' => $request->family,
            'national_code' => $request->national_code,
            'mobile' => $request->mobile,
        ]);
        return successResponse([
            'user' => $user,
            'token' => $user->createToken('register')->plainTextToken
        ]);
    }

    public function login(UserLoginRequest $request){

        $user = User::query()->where('national_code' , $request->national_code)
            ->where('mobile' , $request->mobile)->first();

        if ($user){
            return successResponse([
                'user' => $user,
                'token' => $user->createToken('register')->plainTextToken
            ]);
        }else{
            return errorResponse('کاربر یافت نشد');
        }
    }

}
