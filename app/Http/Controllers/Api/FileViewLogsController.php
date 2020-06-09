<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FileViewLogResource;
use App\Http\Requests\Api\FileViewLogRequest;
use App\User;
use App\FileViewLog;

class FileViewLogsController extends Controller
{
    public function store(FileViewLogRequest $request)
    {
        // 根据 code 获取微信 openid 和 session_key
        try {
            $user = auth('api')->getUser();
            FileViewLog::create([
                'user_id' => $user->id,
                'file_id' => $request->file_id,
                'qm_img' => $request->file_img_url
            ]);

            if (!$user->name || $user->name == "新用户") {
                $attributes['name'] = $request->r_name;
            }

            if (!$user->r_name || $user->r_name == "新用户") {
                $attributes['r_name'] = $request->r_name;
            }

            if (!$user->phone) {
                $attributes['phone'] = $request->phone;
            }
            if (!$user->name && !$user->r_name && !$user->phone) {
                $user->update($attributes);
            }

            $result['status'] = 1;
        } catch (Exception $e) {
            $result['status'] = 0;
        }
        return $result;
    }
}
