<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){ return redirect('/login'); });

//用户路由
//注册页面
Route::get('/register', 'RegisterController@index');
//注册行为
Route::post('/register', 'RegisterController@register');
//登陆页面
Route::get('/login', 'LoginController@index')->name('login');
//登录行为
Route::post('/login', 'LoginController@login');


Route::group(['middleware' => 'auth:web'], function (){
    //登出行为
    Route::get('/logout', 'LoginController@logout');
    //个人设置页面
    Route::get('/user/me/setting', 'UserController@setting');
    //个人设置操作
    Route::post('/user/me/setting', 'UserController@settingStore');
    //个人主页
    Route::get('/user/index', 'UserController@index');

    //文章路由
    Route::get('/home', 'HomeController@index');
    //文章列表页
    Route::get('/posts', 'ArticleController@index');
    //创建文章
    Route::get('/posts/create', 'ArticleController@create');
    Route::post('/posts', 'ArticleController@store');
    //文章详情页
    Route::get('/posts/{post}', 'ArticleController@show');
    //编辑文章
    Route::get('/posts/{post}/edit', 'ArticleController@edit');
    Route::post('/posts/{post}', 'ArticleController@update');
    //删除文章
    Route::get('/posts/{post}/delete', 'ArticleController@delete');

    //评论提交
    Route::post('/posts/{post}/comment', 'ArticleController@comment');

    //文章点赞
    Route::get('/posts/{post}/zan', 'ArticleController@zan');
    //文章取消点赞
    Route::get('/posts/{post}/deletezan', 'ArticleController@deletezan');
});

