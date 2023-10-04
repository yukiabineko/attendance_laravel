<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $user = \Auth::user();
        $user-> createAttendance();
        //モバイルからかパソコンからか
        $device = !\Agent::isMobile() ? 'pc' : 'mobile';
        $attendances = $user->getAttendances();

        return view('home',[
            'user' => $user,
            'attendances' => $attendances,
            'device' => $device
        ]);
    }
}
