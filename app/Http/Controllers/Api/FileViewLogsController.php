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
            $miniProgram = \EasyWeChat::miniProgram();
            $data = $miniProgram->auth->session($request->code);
            // 找到 openid 对应的用户
            $user = User::where('weixin_openid', $data['openid'])->first();
            // 不存在就注册用户
            if (!$user) {
                $user = User::create([
                    'weixin_openid' => $data['openid'],
                    'weixin_session_key' => $data['session_key'],
                    'name' => $request->r_name,
                    'r_name' => $request->r_name,
                    'phone' => $request->phone,
                ]);
            }
            // 添加阅读记录
            FileViewLog::create([
                'user_id' => $user->id,
                'file_id' => $request->file_id,
                'qm_img' => $request->file_img_url
            ]);

            $result['status'] = 1;
        } catch (Exception $e) {
            $result['status'] = 0;
        }
        return $result;
    }
}
