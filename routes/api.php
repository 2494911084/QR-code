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
    // 获取指定二维码的交底文件
    Route::get('qrs/{qr}', 'QrsController@show')->name('qrs.show');
    // 签名图片上传
    Route::post('qm_upload', 'QrsController@qm_upload')->name('qrs.upload');
});
