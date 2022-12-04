<?php


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

if (!function_exists('upload_file_storage')) {
    function upload_file_storage(
        UploadedFile $file,
        string       $extraPath = 'images',
        string       $extraName = '',
    )
    {
        $newName = Str::random(10)
            . $extraName
            . '.' . $file->getClientOriginalExtension();
        $result = Storage::putFileAs($extraPath, $file, $newName);
        if ($result)
            return [
                'path' => $result,
                'url' => Storage::url($result)
            ];
        else
            throw new UploadException(message: 'can not save file please try again later');
    }
}

if (!function_exists('show_error_validation')) {
    function show_error_validation(Validator $validator, bool $all = false): string
    {
        return $all ?
            implode(' , ', array_merge(...array_values($validator->errors()->messages())))
            : $validator->errors()->messages()[array_key_first($validator->errors()->messages())][0];
    }
}

if (!function_exists('send_fcm')) {
    function send_fcm(array $regis, mixed $data = [1, 2], string $title = '', string $body = ''): string
    {
        $client = new \GuzzleHttp\Client(['headers' =>
            ['Authorization' =>
                "key=" . config('app.fcm'),
                'content-type' => 'application/json']]);

        $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => [
                'registration_ids' => $regis,
                'data' => $data,
                'notification' => [
                    'title' => $title,
                    'body' => $body
                ]
            ]
        ]);

        return $res->getBody()->getContents();
    }
}

if (!function_exists('replace_space')) {
    function replace_space(string $name): string
    {
        return str_replace(" ", '-', strtolower($name));
    }
}

if (!function_exists('distance_coordinate')) {
    function distance_coordinate($lat1, $lng1, $lat2, $lng2): float|int
    {
        //km
        return 6371 * acos(cos(deg2rad($lat2))
                * cos(deg2rad($lat1))
                * cos(deg2rad($lng1) - deg2rad($lng2))
                + sin(deg2rad($lat2))
                * sin(deg2rad($lat1)));
    }
}

