<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $user = \Auth::user();
        $user-> createAttendance();

        return view('home');
    }
}
