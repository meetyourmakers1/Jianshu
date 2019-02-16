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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:web'],function(){
    //文章列表
    Route::get('/posts','PostController@index');
    //文章详情
    Route::get('/posts/detail/{post}','PostController@detailView');
    //创建文章
    Route::get('/posts/create','PostController@createView');
    //图片上传
    Route::post('/posts/imageupload', 'PostController@imageUpload');
    /*创建文章操作*/
    Route::post('/posts/createhandle','PostController@createHandle');
    //编辑文章
    Route::get('/posts/edit/{post}','PostController@editView');
    /*编辑文章操作*/
    Route::put('/posts/edithandle/{post}','PostController@editHandle');
    //删除文章
    Route::get('/posts/delete/{post}','PostController@deleteHandle');
    //评论操作
    Route::post('/posts/commenthandle/{post}', 'PostController@commentHandle');
    //赞操作
    Route::get('/posts/zanhandle/{post}', 'PostController@zanHandle');
    //取消赞操作
    Route::get('/posts/unzanhandle/{post}', 'PostController@unZanHandle');
    //搜索文章操作
    Route::get('/posts/searchandle', 'PostController@searchHandle');

    //个人设置
    Route::get('/user/setting/{user}','UserController@index');
    //个人设置操作
    Route::post('/user/setting','UserController@settingHandle');

    //个人中心
    Route::get('/user/detail/{user}','UserController@detail');
    //关注某人
    Route::post('/user/fan/{user}','UserController@fanHandle');
    //取消关注
    Route::post('/user/unfan/{user}','UserController@unFanHandle');

    //专题详情
    Route::get('/topic/{topic}','TopicController@index');
    //投稿
    Route::post('/topic/submit/{topic}','TopicController@submit');
});

//用户注册
Route::get('/regist','RegistController@index');
//注册操作
Route::post('/regist','RegistController@registHandle');
//用户登录
Route::get('/login','LoginController@index')->name('login');
//登录操作
Route::post('/login','LoginController@loginHandle');
//登出操作
Route::get('/logout','LoginController@logoutHandle');

//通知列表
Route::get('/notice','NoticeController@index');
//后台管理
include_once('admin.php');