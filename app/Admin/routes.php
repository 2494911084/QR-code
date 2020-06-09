<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', 'UserController');
    $router->resource('files', 'FileController');
    $router->resource('file_view_logs', 'FileViewLogController');
    $router->resource('qrs', 'QrController');
    $router->resource('registers', 'RegisterController');
    $router->resource('register_logs', 'RegisterLogController');
    $router->resource('subjects', 'SubjectController');
    $router->resource('subject_qrs', 'SubjectQrController');
});
