<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\User as RulesUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    /************************************ */
    /**
     * ユーザー個別ページ
     */
    public function show(User $user, Request $request){
        $this->authorize('update', $user);
        $auth_user = \Auth::user();

        if( $auth_user->admin == 1 && $user->id == $auth_user->id){
            return redirect( route('admin.home'));
        }



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
    
    /******************************************************* */
    /**
     * ユーザー編集処理
     */
    public function update(User $user, Request $request){
        $this->authorize('update', $user);
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'employee_number' => [
                'required', 
                'min:8',
            ],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'base_time' => ['required'],
            /*'start_time' => ['required'],*/
            'finish_time' => [new RulesUser($request->start_time )],
        ]);
        
        //バリデーションエラーの場合入力画面に戻る
          if ($validator->fails()) {
            if( \Auth::user()->admin ==0){
                return redirect(route('users.edit', $user))
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                return redirect(route('users.index'))
                    ->withErrors($validator)
                    ->withInput(); 
            }
           
          }
          $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'affiliation' => $request->affiliation,
            'employee_number' => $request->employee_number,
            'password' => Hash::make( $request->password ),
            'base_time' => $request-> base_time,
            'start_time' => $request->start_time,
            'finish_time' => $request->finish_time
          ]);
          return \Auth::user()->admin == 0? 
          redirect( route('users.show', \Auth::user()))->with('flash', '編集しました。') :
          redirect(route('users.index'))->with('flash', $user->name.'さんの編集しました。');

    }
    
    
}
