<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户所有文章
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //我的所有粉丝
    public function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }
    //我的所有关注
    public function stars(){
        return $this->hasMany(\App\Fan::class,'fans_id','id');
    }
    //关注某一个人
    public function fanHandle($user_id){
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->save($fan);
    }
    //取消关注某人
    public function unFanHandle($user_id){
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->delete($fan);
    }
    //某人是否关注当前用户
    public function hasFans($user_id){
        return $this->fans()->where('fans_id',$user_id)->count();
    }
    //当前用户是否关注某人
    public function hasStar($user_id){
        return $this->stars()->where('star_id',$user_id)->count();
    }
    //用户收到的通知
    public function notices(){
        return $this->belongsToMany(\App\Notice::class,'user_notices','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }
    //给用户发送通知
    public function addNotice($notice){
        return $this->notices()->save($notice);
    }
}
