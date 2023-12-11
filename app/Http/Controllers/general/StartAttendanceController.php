<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class StartAttendanceController extends Controller
{
/*************************出勤時間の登録******************************************************* */
   public function update(Request $request){
     $attendance = Attendance::where('id', $request->attendance_id )->first();
     $start = date('Y-m-d H:').every_15_minutes();
     $attendance->update([
        'started_at' => $start
     ]);
     return redirect('home')->with('flash', '出勤しました。');
   }
}
