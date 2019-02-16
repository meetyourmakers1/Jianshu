<?php

namespace App;

use App\Model as Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use Searchable;
    //定义索引中的type
    public function searchableAs()
    {
        return 'post';
    }
    //定义索引中的field
    public function toSearchableArray()
    {
        return [
          'title' => $this->title,
          'content' => $this->content,
        ];
    }

    //关联用户
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
    //关联评论
    public function comments()
    {
        return $this->hasMany('\App\Comment')->orderBy('created_at', 'desc');
    }
    //关联赞
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //关联所有赞
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }
    //当前用户的文章
    public function scopeInAuthor(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }
    //不属于某个专题的文章
    public function scopeNotInTopic(Builder $query,$topic_id){
        return $query->doesntHave('postTopics','and',function($q) use ($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }
    //全局scope 重写boot方法
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('avaiable',function(Builder $builder){
            $builder->whereIn('status',[0,1]);
        });
    }
}
