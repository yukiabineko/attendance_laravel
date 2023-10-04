<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class FinishAttendanceController extends Controller
{
  /*************************************************** */
  /**
   * 退勤ボタンが押された場合の処理
   */
  public function  update(Request $request){
    $attendance = Attendance::where('id', $request->attendance_id )->first();
    $attendance->update([
       'finished_at' => date('Y-m-d H:i')
    ]);
    return redirect('home')->with('flash', '退勤しました。');
  }
}
