<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\post;
use \App\zan;
use \App\comment;

class ArticleController extends Controller
{
    //列表页
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->where('status','=','1')->withcount(['comments','zans'])->paginate(6);

        return view('post/index',compact('posts'));
    }

    //详情页
    public function show(Post $post)
    {
        //文章评论
        $post->load('comments');
        //赞
        $zan = $post->zan(\Auth::id())->exists();

        return view('post/show',compact('post','zan'));
    }

    //创建文章逻辑
    public function create()
    {
        return view('post/create');
    }

    //创建文章逻辑
    public function store()
    {
        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));

        $post = post::create($params);

        //渲染
        return redirect('/posts');
    }


    //文章编辑页
    public function edit(Post $post)
    {
        return view('post/edit',compact('post'));
    }


    //编辑逻辑
    public function update(Post $post)
    {
        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $this->authorize('update',$post);
        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect("posts/{$post->id}");
    }


    //删除文章
    public function delete(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect('posts');
    }


    //提交评论
    public function comment(Post $post)
    {
        //验证
        $this->validate(request(),[
            'content' => 'required|min:3',
        ]);

        //逻辑
        $post_id = $post->id;
        $content = request('content');
        $user_id = \Auth::id();

        $params = compact('post_id','content','user_id');
        $comment = comment::create($params);

        //渲染
        return back();
    }


    //点赞
    public function zan(Post $post)
    {
        //逻辑
        $post_id = $post->id;
        $user_id = \Auth::id();
        $params = compact('post_id','user_id');
        //存在就返回数据，不存在就添加
        zan::firstOrCreate($params);

        //渲染
        return back();
    }


    //取消点赞
    public function deletezan(Post $post)
    {
//        //逻辑
//        $id = DB::select('select id from zans where post_id = ? && user_id = ?',[
//            $post->id,
//            \Auth::id()
//        ]);
//
//        if($id[0]->id) {
//            DB::delete('delete from zans where id = ?',[
//                $id[0]->id
//            ]);
//        }

        $post->zan(\Auth::id())->delete();

        //渲染
        return back();
    }


}
