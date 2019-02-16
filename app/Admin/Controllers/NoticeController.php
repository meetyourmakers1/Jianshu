<?php

namespace App\Admin\Controllers;

use \App\AdminRole;
use \App\AdminPermission;

class NoticeController extends Controller
{
    //通知列表
    public function index(){
        $notices = \App\Notice::all();
        return view('admin.notice.index',compact('notices'));
    }
    //创建通知页面
    public function create(){
        return view('admin.notice.create');
    }
    //创建通知操作
    public function store(){
        $this->validate(request(),[
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        $notice = \App\Notice::create(request(['title','content']));

        $this->dispatch(new \App\Jobs\SendNotice($notice));

        return redirect('/admin/notice');
    }

}