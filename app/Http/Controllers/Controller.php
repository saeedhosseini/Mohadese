<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'national_code' => ['required', 'string',
                'min:10', 'max:10', Rule::unique('users', 'national_code')],
            'mobile' => ['required', 'string', Rule::unique('users', 'mobile')]
        ]);

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

    public function login(Request $request){
        $request->validate([
            'national_code' => ['required', 'string',
                'min:10', 'max:10'],
            'mobile' => ['required', 'string']
        ]);

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
