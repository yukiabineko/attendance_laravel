<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 管理者ホーム画面
     */
    public function home(){
        return view('admin.home');
    }
}
