<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use App\Rules\attendance_edit_superior;
use App\Rules\attendance_not_finish;
use App\Rules\attendance_not_start;
use App\Rules\Attendance_time;
use Illuminate\Http\Request;
use Validator;

class AttendanceController extends Controller
{
  /*************編集ページ*********************************** */
  public function edit(User $user, Request $request){
    //モバイルからかパソコンからか
    $device = !\Agent::isMobile() ? 'pc' : 'mobile';
    $attendances = $user->getAttendances( $request->date );
    $superiors = User::where('superior', 1)->get();
   
        
    return view('general.attendances.edit',[
        'user' => $user,
        'attendances' => $attendances,
        'device' => $device,
        'date' => $request->date,
        'superiors' => $superiors
    ]);
  }
  /*************編集処理********************************************** */
  public function update(Request $request){

    $validator = Validator::make($request->all(), [
      'started_at' => [ new attendance_not_finish( $request)],
      'finished_at' => [ 
        new Attendance_time($request),
        new attendance_not_start( $request ),
       
      ],
      
    ]);

    if ($validator->fails()) {
        return redirect()->back()
        ->withInput()
        ->withErrors($validator);
    }
    
    foreach( $request->attendance_id as $i => $id ){
      if( !empty( $request->started_at[$i]) 
      && !empty( $request->finished_at[$i]) ){
        $attendance = Attendance::where('id', $id)->first();
        $user = $attendance->user()->first();

        $now_date = $request->worked_on[$i];
        $new_start_time = $request->started_at[$i];
        $new_end_time = $request->finished_at[$i];
        $new_start_datetime = "$now_date $new_start_time";
        $new_end_datetime = "$now_date $new_end_time";
        $edit_superior_id = $request->superior_id[$i];
        $edit_approval = isset( $edit_superior_id )? 1 : 0;
       
        if( isset($edit_superior_id) ){
            $attendance->update([
              'started_at' => $new_start_datetime,
              'finished_at' => $new_end_datetime,
              'note' => $request->context[$i],
              'edit_superior_id' => $edit_superior_id,
              'edit_approval' => $edit_approval
            ]);
        }
      }
    }
    if (\Auth::user()->admin == 1 ) {
      return redirect( route('admin.home'))->with('flash', $user->name.'さんの勤怠編集しました。');
    }
    return redirect( route('users.show',['user'=> \Auth::user(), 'date' => $request->date]))
           ->with('flash', '編集しました。');
  }
/******************************************************************** */

}
