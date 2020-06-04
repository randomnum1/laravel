<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = ['fan_id', 'star_id'];

    // 被关注用户
    public function suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
}
