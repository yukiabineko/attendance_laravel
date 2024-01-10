<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeavingController extends Controller
{
    /**
     * 退勤者リスト
     */
    public function index(){
        $targets = DB::table('attendances')
        ->join('users', 'users.id', '=', 'attendances.user_id')
        ->select('users.*', 'attendances.*')
        ->where('worked_on', date('Y-m-d'))
            ->where('attendances.started_at', '!=', null)
            ->where('attendances.finished_at','!=', null)
            ->get();

        //モバイルからかパソコンからか
        $device = !\Agent::isMobile() ? 'pc' : 'mobile';

        return view('admin.leaving.index',[
            'attendances' => $targets,
            'device' => $device
        ]);
    }
}
