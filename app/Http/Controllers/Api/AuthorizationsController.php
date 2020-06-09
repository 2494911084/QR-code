<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Api\WeappAuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;

        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            throw new AuthenticationException('code 不正确');
        }

        // 找到 openid 对应的用户
        $user = User::where('weixin_openid', $data['openid'])->first();

        // $attributes['weixin_session_key'] = $data['session_key'];

        // 未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {
            // 如果查询不到这个用户,则添加一个用户
            $user = User::create([
                'weixin_openid' => $data['openid'],
                'weixin_session_key' => $data['session_key']
            ]);
        }
        // 为对应用户创建 JWT
        $token = auth('api')->login($user);

        return response()->json([
            'access_token' => $token,
            'openid' => $user->weixin_openid,
            'weixin_session_key' => $user->weixin_session_key,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    public function update()
    {
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        auth('api')->logout();
        return response(null, 204);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
