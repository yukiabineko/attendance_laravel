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
     $attendance->update([
        'started_at' => date('Y-m-d H:i')
     ]);
     return redirect('home')->with('flash', '出勤しました。');
   }
}
