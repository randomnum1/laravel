<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        //专题下的文章
        $article = DB::select('select p.*,u.name from post_topics as t left join posts as p on t.post_id = p.id left join users as u on p.user_id = u.id where topic_id = ?',[
            $topic->id
        ]);

        //我的文章
        $myArticle = DB::select('select p.*,t.topic_id from post_topics as t left join posts as p on t.post_id = p.id where topic_id = ? & user_id = ?',[
            $topic->id,
            \Auth::id()
        ]);
        $myArticle = array_map('get_object_vars', $myArticle);
//        dd($myArticle);
        foreach($myArticle as $k=>$v) {
            if($v['topic_id'] == $topic->id){
                unset($myArticle[$k]);
            }
        }

        return view('topic/show',compact('topic','article','myArticle'));
    }

    public function submit(Topic $topic)
    {
        return ;
    }
}
