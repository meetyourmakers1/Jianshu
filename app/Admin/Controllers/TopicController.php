<?php

namespace App\Admin\Controllers;

use \App\AdminRole;
use \App\AdminPermission;

class TopicController extends Controller
{
    //专题列表
    public function index(){
        $topics = \App\Topic::all();
        return view('admin.topic.index',compact('topics'));
    }
    //创建专题页面
    public function create(){
        return view('admin.topic.create');
    }
    //创建专题操作
    public function store(){
        $this->validate(request(),[
           'name' => 'required'
        ]);
        \App\Topic::create(['name' => request('name')]);
        return redirect('/admin/topic');
    }
    //删除专题操作
    public function destroy(\App\Topic $topic){
        $topic->delete();
        return [
            'error' => 0,
            'message' => ''
        ];
    }
}