<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Qr;
use App\File;
use App\Http\Resources\QrResource;
use App\Handlers\ImageUploadHandler;

class QrsController extends Controller
{
    public function show(Qr $qr, Request $request)
    {
        $files_id = $qr->content;
        $files_id = json_decode($files_id);
        $file_array = [];
        foreach ($files_id as $key => $value) {
             $file = File::find($value);
             $file['file'] = config('app.url') ."/uploads/" . $file['file'];
             $file_array[] = $file;
        }
        // $files_id_array = \Str::toArray($files_id);
        return $file_array;
    }

    public function qm_upload(Request $request, ImageUploadHandler $uploader)
    {
        $result = $uploader->save($request->image);

        return $result['path'];
    }
}
