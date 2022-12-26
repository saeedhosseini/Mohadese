<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Str;

class BotController extends Controller
{

    private string $path = 'public_html/downloads/talashnet';

    public function init(){
        echo Storage::exists('public_html/downloads/talashnet');
        if (!Storage::exists($this->path))
        Storage::makeDirectory($this->path);

        return response()->json(Storage::files($this->path));
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
        $name = ($request->query('name') ?? Str::random()) . '.' . $request->query('format');
        $path = $this->path . $name;
        Storage::put(path: $path, contents: $fileContent);
        return response()->json([
            'path' => $path,
            'download_url' => 'https://download.codelego.ir/downloads/talashnet/' . $name
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
