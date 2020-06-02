<?php

namespace App;

use App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email','password'];

    //关联用户的文章列表
    public function post()
    {
        return $this->hasMany(\App\Post::class);
    }

}
