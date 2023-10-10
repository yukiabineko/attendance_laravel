<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
  /*************編集ページ*********************************** */
  public function edit(User $user, Request $request){
    //モバイルからかパソコンからか
    $device = !\Agent::isMobile() ? 'pc' : 'mobile';
    $attendances = $user->getAttendances( $request->date );
        
    return view('general.attendances.edit',[
        'user' => $user,
        'attendances' => $attendances,
        'device' => $device
    ]);
  }
  /*************編集処理********************************************** */
  public function update(Request $request){
    
  }

}
