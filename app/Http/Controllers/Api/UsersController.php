<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Register;
use App\RegisterLog;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function registernew(Register $register)
    {
        // 参数 = 二维码id
        $re_id = $register->id;
        // 查询当前用户 指定二维码的 最新签到记录
        $user = auth('api')->getUser();

        $log = RegisterLog::where([
            'user_id' => $user->id,
            'register_id' => $re_id
        ])->orderBy('created_at')->first();
        if ($log) {
            $todaycheck = Carbon::now()->toDateString($log['created_at']) == Carbon::now()->toDateString() ? 1 : 0;
            $new_register_data = Carbon::now()->toAtomString($log['created_at']);
        } else {
            $todaycheck = 0;
            $new_register_data = '未签到';
        }
        return [
            'todaycheck' => $todaycheck,
            'new_register_data' => $new_register_data
        ];
    }

    public function register_log_store(Register $register)
    {
        // 参数 = 二维码id
        $re_id = $register->id;
        // 查询当前用户
        $user = auth('api')->getUser();
        // 查询签到记录:今日已签到,则结束;
        $log = RegisterLog::where([
            'user_id' => $user->id,
            'register_id' => $re_id
        ])->orderBy('created_at')->first();

        if ($log) {
            $todaycheck = Carbon::now()->toDateString($log['created_at']) == Carbon::now()->toDateString() ? 1 : 0;
            $new_register_data = Carbon::now()->toAtomString($log['created_at']);
        }

        if (!$log || $todaycheck == 0) {
            // 创建签到记录
            $log = RegisterLog::create([
                'register_id' => $re_id,
                'user_id' => $user->id
            ]);

            $todaycheck = 1;
        }

        return [
            'todaycheck' => $todaycheck,
            'new_register_data' => Carbon::now()->toAtomString($log['created_at'])
        ];
    }
}
