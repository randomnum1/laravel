<?php

namespace App;

use App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email','password'];

    //关联用户的文章列表
    public function posts()
    {
        return $this->hasMany(\App\Post::class);
    }

    //关联粉丝数
    public function fans()
    {
        return $this->hasMany('App\Fan','star_id','id');
    }

    //关联关注人数
    public function starts()
    {
        return $this->hasMany('App\Fan','fan_id','id');
    }

    // 当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    // 当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->starts()->where('star_id', $uid)->count();
    }

}
