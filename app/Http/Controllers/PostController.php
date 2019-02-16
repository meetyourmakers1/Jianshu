<?php

namespace App\Http\Controllers;

use App\Zan;
use Illuminate\Http\Request;
use \App\Post;
use \App\Comment;

class PostController extends Controller
{
    //文章列表
    public function index(){
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(5);
        return view('post/index',compact('posts'));
    }
    //文章详情
    public function detailView(Post $post){
        $post->load('comments');
        return view('post/detail',compact('post'));
    }
    //创建文章
    public function createView(){
        return view('post/create');
    }
    //图片上传操作
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }
    //创建文章操作
    public function createHandle(Request $request){
        $this->validate($request, [
            'title' => 'required|min:1',
            'content' => 'required|min:1',
        ]);
        $user_id = \Auth::id();
        Post::create(array_merge(request(['title','content']),compact('user_id')));
        return redirect('/posts');
    }
    //编辑文章
    public function editView(Post $post){
        return view('post/edit',compact('post'));
    }
    //编辑文章操作
    public function editHandle(Post $post){
        $this->validate(\request(), [
            'title' => 'required|min:1',
            'content' => 'required|min:1',
        ]);
        $this->authorize('update', $post);
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();
        return redirect("/posts");
    }
    //删除文章操作
    public function deleteHandle(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return redirect("/posts");
    }
    //评论操作
    public function commentHandle(Post $post){
        $this->validate(request(),[
            'content' => 'required|min:1',
        ]);
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);
        return back();
    }
    //赞操作
    public function zanHandle(Post $post){
        $zan = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($zan);
        return back();
    }
    //取消赞操作
    public function unZanHandle(Post $post){
        $post->zan(\Auth::id())->delete();
        return back();
    }
    //搜索文章操作
    public function searchHandle(){
        $this->validate(\request(),[
            'query' => 'required'
        ]);
        $query = \request('query');
        $posts = \App\Post::search($query)->paginate(1);
        return view('post/search',compact('posts','query'));
    }
}
