<?php

//后台管理
Route::group(['prefix' => 'admin'],function(){
    //登录页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登录操作
    Route::post('/login','\App\Admin\Controllers\LoginController@loginHandle');
    //登出操作
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware' => 'auth:admin'],function(){
        //后台首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware' => 'can:system'],function(){
            /*管理员模块*/
            //管理员列表
            Route::get('/user','\App\Admin\Controllers\UserController@index');
            //管理员创建页面
            Route::get('/user/create','\App\Admin\Controllers\UserController@create');
            //管理员创建操作
            Route::post('/user/create','\App\Admin\Controllers\UserController@createHandle');
            //用户角色页面
            Route::get('/user/role/{user}','\App\Admin\Controllers\UserController@role');
            //保存用户角色操作
            Route::post('/user/role/{user}','\App\Admin\Controllers\UserController@roleHandle');

            /*角色模块*/
            //角色列表
            Route::get('/role','\App\Admin\Controllers\RoleController@index');
            //添加角色页面
            Route::get('/role/create','\App\Admin\Controllers\RoleController@create');
            //添加角色操作
            Route::post('/role/create','\App\Admin\Controllers\RoleController@createHandle');
            //角色权限页面
            Route::get('/role/permission/{role}','\App\Admin\Controllers\RoleController@permission');
            //保存角色权限操作
            Route::post('/role/permission/{role}','\App\Admin\Controllers\RoleController@permissionHandle');

            /*权限模块*/
            //权限列表
            Route::get('/permission','\App\Admin\Controllers\PermissionController@index');
            //添加权限页面
            Route::get('/permission/create','\App\Admin\Controllers\PermissionController@create');
            //添加权限操作
            Route::post('/permission/create','\App\Admin\Controllers\PermissionController@createHandle');
        });

        Route::group(['middleware' => 'can:post'],function(){
            /*文章审核模块*/
            //文章审核页面
            Route::get('/posts/','\App\Admin\Controllers\PostController@index');
            //文章审核操作
            Route::post('/posts/check/{post}','\App\Admin\Controllers\PostController@checkHandle');
        });

        //专题模块
        Route::group(['middleware' => 'can:topic'],function(){
            Route::resource('topic','\App\Admin\Controllers\TopicController',['only' => [
                'index','create','store','destroy'
            ]]);
        });

        //通知模块
        Route::group(['middleware' => 'can:topic'],function(){
            Route::resource('notice','\App\Admin\Controllers\NoticeController',['only' => [
                'index','create','store'
            ]]);
        });
    });
});