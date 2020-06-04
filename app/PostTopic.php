<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model
{
    protected $fillable = ['topic_id', 'post_id'];
}
