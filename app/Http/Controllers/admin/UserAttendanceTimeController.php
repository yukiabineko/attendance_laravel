<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAttendanceTimeController extends Controller
{
    /**
     * 各ユーザーの勤務時間編集ページ
     */
    public function edit(User $user){
        return view('admin.userTime.edit',[
            'user' => $user
        ]);
    }
    /**
     * 勤務時間編集処理
     */
    public function update(User $user, Request $request){
        dd($request);
    }
}
