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
    /**************************************** */
    /**csvインポート */
    public function csvImport(Request $request){
       if( $request->hasFile('file')){
          $file = $request->file('file');
          $path = $file->getRealPath();
          //ファイル開く
          $fp = fopen($path, 'r');
          //ヘッダーを削除
          fgetcsv($fp);
          //１行ずつ読み込み
          while(($csvData = fgetcsv($fp)) !== FALSE){
             \print_r($csvData);
             $user = new User();
             $user->name = $csvData[0];
             $user->email = $csvData[1];
             $user->start_time  = $csvData[2];
             $user->finish_time = $csvData[3];
             $user->admin = $csvData[4];
             $user->password = $csvData[5];
             $user->affiliation = $csvData[6];
             $user->employee_number = $csvData[7];
             $user->base_time = $csvData[8];
             $user->superior = $csvData[9];
             $user->save();
          }
          fclose($fp);
          return redirect(route('users.index'))->with('flash', 'csvインポートしました。');
       } 
       else {
            throw new Exception('CSVファイルの取得に失敗しました。');
        }
    }
    /************************************************************** */

}
