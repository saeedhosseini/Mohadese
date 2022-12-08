<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceCreateRequest;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Str;

class InsuranceController extends Controller
{

    public function index(Request $request){
        return successResponse($request->user()->insurances()->get());
    }

    public function store(InsuranceCreateRequest $request){
        return successResponse(Insurance::query()->create([
            'user_id' => $request->user()->id,
            'asset_icon' => $request->asset_icon,
            'factor_id' => Str::random(8),
            'title' => $request->title,
        ]));
    }

}
