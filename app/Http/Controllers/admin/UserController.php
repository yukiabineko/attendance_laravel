<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\User as RulesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /************************************************ */
    /**
     * 管理者のみ従業員一覧
     */
    public function index(){
        $this->authorize('admin',\Auth::user() );

        //モバイルからかパソコンからか
        $device = !\Agent::isMobile() ? 'pc' : 'mobile';
        //管理者を除く従業員一覧の表示
        $users = User::where('admin', 0)->orderBy('id', 'asc')->get();
        

        return view('general.users.index',[
            'device' => $device,
            'users' => $users
        ]);
    }

    /**************************************** */
    /**
     * 新規従業員登録ページ
     */
    public function create(Request $request){
        $this->authorize('admin', \Auth::user());


         //モバイルからかパソコンからか
         $device = !\Agent::isMobile() ? 'pc' : 'mobile';
        
        return view('admin.users.create',[
            'device' => $device
        ]);

    }
    /**************************************** */
    /**
     * 新規従業員登録ページ
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'start_time' => ['required'],
            'finish_time' => ['required', new RulesUser($request->start_time)],
        ]);


        //バリデーションエラーの場合入力画面に戻る
        if ($validator->fails()) {
            return redirect(route('users.create'))
            ->withErrors($validator)
                ->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'start_time' => $request->start_time,
            'finish_time' => $request->finish_time
        ]);
       return redirect( route('admin.home'))->with('flash', '従業員登録しました。');
    }
    
    /************************************* */
    /**
     * 削除
     */
    public function destroy(User $user){
        dd($user);
    }
}
