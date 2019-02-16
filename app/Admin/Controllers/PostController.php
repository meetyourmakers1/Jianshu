<?php

namespace App\Admin\Controllers;

use App\Post;

class PostController extends Controller
{
    //文章审核首页
    public function index(){
        $posts = Post::withoutGlobalScope('vailable')->where('status',0)->orderBy('created_at','desc')->paginate('5');
        return view('admin.post.index',compact('posts'));
    }

    //文章审核操作
    public function checkHandle(Post $post){
        $this->validate(request(),[
            'status' => 'required|in:-1,1',
        ]);

        $post->status = request('status');
        $post->save();

        return [
            'error' => 0,
            'message' => ''
        ];
    }
}