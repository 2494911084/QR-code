<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function() {
    // 小程序登录
    Route::post('weapp/authorizations', 'AuthorizationsController@weappStore')
        ->name('weapp.authorizations.store');
    // 刷新token
    Route::put('authorizations/current', 'AuthorizationsController@update')
        ->name('authorizations.update');
    // 删除token
    Route::delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('authorizations.destroy');
    // 获取指定二维码的交底文件
    Route::get('qrs/{qr}', 'QrsController@show')->name('qrs.show');
    // 签名图片上传
    Route::post('qm_upload', 'QrsController@qm_upload')->name('qrs.upload');
    // 已阅表单提交-添加微信用户-添加阅读记录
    Route::post('file_view_log', 'FileViewLogsController@store')->name('file_view_logs.store');
});
