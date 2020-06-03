<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\User;

class UserController extends Controller
{

    //个人设置页面
    public function setting()
    {
        $user = \Auth::user();
        return view('user/setting',compact('user'));
    }

    //个人设置行为
    public function settingStore(Request $request)
    {
        //验证
        $this->validate(request(),[
           'name' => 'required|min:3|max:10',
        ]);

        //逻辑
        $name = request('name');
        $user = \Auth::user();
        if($name != $user->name) {
            if(User::where('name',$name)->count() > 0){
                dd(1);
                return back()->withErrors('用户名称已被注册');
            }
            $user->name = $name;
        }

        if($request->file('photo')){
            $path = $request->file('photo')->storePublicly($user->id);
            $user->photo = "/storage/" . $path;
        }

        $user->save();

        //渲染
        return back();
    }


    //个人主页
    public function index(User $user)
    {
//        $user = User::get();

        //文章列表
        $post = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        //关注的用户,包含关注用户的 关注/粉丝/文章数

        //这个人的粉丝数

        return view('user/index',compact('user','post'));
    }

    //关注
    public function fan()
    {

    }

    //取消关注
    public function unfan()
    {

    }


}
