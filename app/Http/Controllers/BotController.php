<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class BotController extends Controller
{

    public function index(Request $request){
        $link = $request->query('link');
        $fileContent = file_get_contents($link);
        Storage::put();
        return successResponse($request->user()->insurances()->get());
    }

}
