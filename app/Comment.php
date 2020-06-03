<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'content','post_id'];

    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
