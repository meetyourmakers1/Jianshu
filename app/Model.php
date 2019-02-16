<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel{
    //protected $guarded = [];     //不允许注入字段
    protected $fillable = ['title','content','user_id','post_id','name','description'];   //允许注入数据字段
}