<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /************************************ */
    /**
     * ユーザー個別ページ
     */
    public function show(User $user, Request $request){
        $this->authorize('update', $user);
        $user-> createAttendance( $request->date );
        //モバイルからかパソコンからか
        $device = !\Agent::isMobile() ? 'pc' : 'mobile';
        $attendances = $user->getAttendances( $request->date );
        

        return view('home',[
            'user' => $user,
            'attendances' => $attendances,
            'device' => $device
        ]);
    }
    /************************************ */
    /**
     * ユーザー編集ページ表示
     */
    public function edit(User $user){
        $this->authorize('update', $user);
         //モバイルからかパソコンからか
         $device = !\Agent::isMobile() ? 'pc' : 'mobile';
        return view('general.users.edit',[
            'user' => $user,
            'device' => $device
        ]);
    }
}
