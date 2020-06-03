<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    protected $fillable = ['title', 'content','user_id'];

    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //关联评论
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    //和用户进行关联
    public function zan($user_id)
    {
        return $this->hasone('App\zan')->where('user_id',$user_id);
    }

    //文章的赞列表
    public function zans()
    {
        return $this->hasMany('App\zan') ;
    }

}
