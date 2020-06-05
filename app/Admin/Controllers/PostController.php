<?php
namespace App\Admin\Controllers;

use \App\post;
use \App\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $posts = post::where('status','=','0')->paginate(10);
        return view('admin.post.index',compact('posts'));
    }

    public function status(Post $post)
    {
        //验证
        $this->validate(request(),[
            'status' => 'required|in:-1,1'
        ]);

        //逻辑
        $post->status = request('status');
        $post->save();

        //渲染
        return [
            'error' => 0,
            'msg' => ''
        ];
    }


}
