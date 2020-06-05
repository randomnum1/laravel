<?php
namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //首页
    public function index()
    {
        return view('admin.home.index');
    }

}
