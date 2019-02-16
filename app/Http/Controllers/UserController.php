<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //用户设置
    public function index(){
        return view('user/index');
    }
    //设置操作
    public function settingHandle(){

    }
    //个人中心
    public function detail(User $user){
        $user = User::withCount(['stars','fans','posts'])->find($user->id);

        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        $stars = $user->stars;
        $star_user = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        $fans = $user->fans;
        $fans_user = User::whereIn('id',$fans->pluck('fans_id'))->withCount(['stars','fans','posts'])->get();

        return view('user/detail',compact('user','posts','star_user','fans_user'));
    }
    //关注某人
    public function fanHandle(User $user){
        $me = \Auth::user();
        $me->fanHandle($user->id);
        return [
            'error' => 0,
            'message' => ''
        ];
    }
    //取消关注
    public function unFanHandle(User $user){
        $me = \Auth::user();
        $me->unFanHandle($user->id);
        return [
            'error' => 0,
            'message' => ''
        ];
    }
}
