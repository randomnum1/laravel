<?php
namespace App\Admin\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        //验证
        $this->validate(request(),[
            'name' => 'required|unique:admin_users,name|min:2|max:10|',
            'password' => 'required|min:5|max:10|'
        ]);

        //逻辑
        $name = request('name');
        $password = bcrypt(request('name'));
        AdminUser::create(compact('name','password'));

        //渲染
        return redirect('admin/users');
    }

}
