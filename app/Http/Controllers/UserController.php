<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    //个人主页
    public function index()
    {
        $user = \Auth::user();
        $posts = DB::select('select *,users.name from posts left join users on posts.user_id = users.id where user_id = ?',[$user->id]);

        return view('user/index',compact('user','posts'));
    }


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


}
