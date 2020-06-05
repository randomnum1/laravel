<?php

Route::group(['prefix' => 'admin'], function (){

    //登陆页面展示
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    //登陆行为
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    //登出行为
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware' => 'auth:admin'],function(){
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');

        //管理人员列表
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        //管理人员增加
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
        //文章核
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');

    });

});
