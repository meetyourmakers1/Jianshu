<?php

namespace App;

use App\Model as Model;

class Comment extends Model
{
    //关联文章
    public function post(){
        return $this->belongsTo('\App\Post');
    }
    //关联用户
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
