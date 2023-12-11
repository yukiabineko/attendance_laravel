<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\User as RulesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAttendanceTimeController extends Controller
{
    /**
     * 各ユーザーの勤務時間編集ページ
     */
    public function edit(User $user){
        $this->authorize('admin', \Auth::user());
        return view('admin.userTime.edit',[
            'user' => $user
        ]);
    }
    /**
     * 勤務時間編集処理
     */
    public function update(User $user, Request $request){
        
        $validator = Validator::make($request->all(), [
            'start_time' => ['required'],
            'finish_time' => ['required', new RulesUser($request->start_time)]
        ]);
        //バリデーションエラーの場合入力画面に戻る
        if ($validator->fails()) {
            return redirect(route('userTime.edit',$user))
            ->withErrors($validator)
            ->withInput();
        }
        $user->update([
           'starte_time' => $request->start_time,
           'finish_time' => $request->finish_time
        ]);
        return redirect(route('admin.home'))->with('flash', $user->name.'さんの勤怠時間編集しました。');

    }
}
