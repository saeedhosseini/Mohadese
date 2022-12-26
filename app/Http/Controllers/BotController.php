<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Str;

class BotController extends Controller
{

    public function init(){
        Storage::makeDirectory('downloads/almtserver');
        return response()->json(Storage::files('downloads/almtserver'));
    }

    public function index(Request $request)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $link = $request->query('link');
        $fileContent = file_get_contents($link, false, stream_context_create($arrContextOptions));
        $path = 'downloads/almtserver/' . ($request->query('name') ?? Str::random()) . '.' . $request->query('format');
        Storage::put(path: $path, contents: $fileContent);
        return response()->json([
            'path' => $path,
            'download_url' => 'https://download.codelego.ir/' . $path
        ]);
    }

    public function delete(Request $request)
    {
        if (Storage::delete($request->query('path'))) {
            return response()->json([
                'result' => 'successfully deleted'
            ]);
        } else {
            return response()->json([
                'result' => 'File not found or can not delete this file'
            ]);
        }
    }

}
