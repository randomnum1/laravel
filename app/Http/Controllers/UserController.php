<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\User;
use \App\Fan;

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
        //这个人的信息，包含关注、粉丝、文章数
        $user = User::withCount(['starts','fans','posts'])->find($user->id);

        //这个人的文章列表，取前10条
        $post = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        //这个人关注的用户,包含关注用户的关注、粉丝、文章数
        $starts = $user->starts;
        $suser = User::whereIn('id',$starts->pluck('star_id'))->withCount(['starts','fans','posts'])->get();

        //关注这个人的粉丝用户，包含粉丝用户的关注、粉丝、文章数
        $fans = $user->fans;
        $fuser = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['starts','fans','posts'])->get();

        return view('user/index',compact('user','post','suser','fuser'));
    }


    //关注
    public function fan(User $user)
    {
        $fan_id = \Auth::user();
        $star_id = $user->id();

        $params = compact('fan_id','star_id');
        $fan = fan::create($params);

        return [
            'error'=>0,
            'message'=>'success'
        ];
    }

    //取消关注
    public function unfan(User $user)
    {
        $fan = new \App\Fan();
        $fan_id = \Auth::user();
        $star_id = $user->id();
        $fan->wherer([
            ['fan_id','=',$fan_id],
            ['star_id','=',$star_id]
        ])->delete();

        return [
            'error'=>0,
            'message'=>'success'
        ];
    }


}
