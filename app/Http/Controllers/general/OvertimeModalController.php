<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class OvertimeModalController extends Controller
{
  /*************************************************************************************************************************** */
    /**
     * 残業申請モーダルの表示
     */
    public function show(int $attendance_id){
      $attendance = Attendance::where('id', $attendance_id)->first();
      $user = $attendance->user()->first();
      $send = [];
      $attendanceArray = $attendance->toArray();
      $superior = User::where('superior', 1)->where('id', '!=', $attendance->user_id)->get()->toArray();
      $send['attendance'] = $attendanceArray;
      $send['user'] = $user;
      $send['superior'] = $superior;
      $json = json_encode($send, \JSON_UNESCAPED_UNICODE);
      echo $json;
    }
  /*************************************************************************************************************************** */
    /**
     *残業申請処理
     */
    public function update(Request $request){
       
       //次の日のチェックがある場合
       if( isset($request->tomorrow ) ){
         
          $tomorrow = date('Y-m-d', \strtotime('+1 day'.$request->worked_on));
          $end_schedule = date('Y-m-d H:i', strtotime("$tomorrow $request->hour:$request->min"));
          //ターゲットの勤怠（翌日)
          $attendance = Attendance::where('user_id', $request->user_id)
            ->where('worked_on', $tomorrow)
            ->first();
       }
       else{
          $end_schedule = date('Y-m-d H:i', strtotime("$request->worked_on $request->hour:$request->min"));
          //ターゲットの勤怠(当日)
          $attendance = Attendance::where('user_id', $request->user_id)
                        ->where('worked_on', $request->worked_on)
                        ->first();
       }
       //残業処理
       $attendance->update([
          'end_schedule' => $end_schedule,
          'overtime_approval' => 1,
          'context' => $request->process,
          'superior_id' => $request->superior,
          'overtime_approval' => $request->approval
       ]);
       return redirect(route('home'))->with('flash', '残業申請しました。');

    }
}
