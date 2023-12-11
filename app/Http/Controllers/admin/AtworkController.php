<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtworkController extends Controller
{
   /**
    * 出勤中一覧
    */
    public function index(){
       $targets = DB::table('attendances')
         ->join('users', 'users.id', '=', 'attendances.user_id')
         ->select('users.*', 'started_at')
         ->where('worked_on', date('Y-m-d'))
         ->where('attendances.started_at', '!=', null)
         ->where('attendances.finished_at', null)
         ->get();
   
       return view('admin.atwork.index',[
         'attendances' => $targets
       ]);
       
    }
}
