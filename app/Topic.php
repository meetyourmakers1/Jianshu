<?php

namespace App;

use App\Model as Model;

class Topic extends Model
{
    protected $fillable = ['name'];

    //专题文章
    public function posts(){
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }
    //专题文章数
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class);
    }
}
