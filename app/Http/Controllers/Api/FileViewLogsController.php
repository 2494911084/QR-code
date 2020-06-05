<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FileViewLogResource;
use App\Http\Requests\Api\FileViewLogRequest;

class FileViewLogsController extends Controller
{
    public function store(FileViewLogRequest $request)
    {
        // 根据code查询openid
        // 查询用户是否存在
        // 不存在就注册用户
        // 添加阅读记录

        return $data['status'] = 0;
    }
}
