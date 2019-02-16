<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    //专题详情
    public function index(Topic $topic){
        $topic = Topic::withCount('postTopics')->find($topic->id);
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
        $my_posts = \App\Post::inAuthor(\Auth::id())->notInTopic($topic->id)->get();
        return view('topic.index',compact('topic','posts','my_posts'));
    }
    //投稿操作
    public function submit(Topic $topic){
        $this->validate(\request(),[
            'post_ids' => 'array'
        ]);
        $post_ids = \request('post_ids');
        $topic_id = $topic->id;
        if($post_ids){
            foreach($post_ids as $post_id){
                $post_topic = new \App\PostTopic;
                $post_topic->topic_id = $topic_id;
                $post_topic->post_id = $post_id;
                $post_topic->save();
                //\App\PostTopic::firstOrCreate(compact('post_id','topic_id'));     //这个方法,日他妈的有问题.
            }
        }
        return back();
    }
}
