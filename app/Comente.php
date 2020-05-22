<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comente extends Model
{
    //
    protected $fillable = ['post_id','user_id','content'];
}
