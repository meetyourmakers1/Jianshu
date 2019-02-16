<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class NoticeController extends Controller
{
    //通知列表
    public function index(){
        $user = \Auth::user();
        $notices = $user->notices;
        return view('notice.index',compact('notices'));
    }
}
