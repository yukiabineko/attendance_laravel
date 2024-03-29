<?php

use App\Http\Controllers\admin\AtworkController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\LeavingController;
use App\Http\Controllers\admin\UserAttendanceTimeController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\general\AttendanceController;
use App\Http\Controllers\general\FinishAttendanceController;
use App\Http\Controllers\general\MonthAuthController;
use App\Http\Controllers\general\OvertimeModalController;
use App\Http\Controllers\general\StartAttendanceController;
use App\Http\Controllers\general\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
      return redirect(route('home'));
    }
    return view('welcome');
});
Route::group(['middleware' =>['auth']], function(){
    Route::get('/home',[HomeController::class, 'home'])->name('home');
    Route::resource('startAttendance', StartAttendanceController::class)->only(['update']);
    Route::resource('finishAttendance', FinishAttendanceController::class)->only(['update']);
    Route::resource('users', UserController::class)->only(['show']);
    //ユーザー個別の勤怠編集ページ
    Route::get('/attendance/{user}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::patch('/attendance/{user}/update',[ AttendanceController::class, 'update'])->name('attendances.update');

    //ユーザー勤怠ページ残業申請モーダールボタン押下
    Route::get('/overtimeModal/{id}',[OvertimeModalController::class, 'show'])->name('overtimeModal.show');
    //ユーザー残業申請処理
    Route::patch('/overtimeModal/update', [OvertimeModalController::class, 'update'])->name('overtimeModal.update');
    //ユーザー一ヶ月申請
    Route::patch('/month_auth/update',[ MonthAuthController::class, 'update'])->name('MonthAuth.update');

    //ユーザープロフィール変更画面
    Route::resource('users', UserController::class)->only(['edit','update', 'show']);
    //管理者版ユーザー管理
    Route::resource('/admin/users',AdminUserController::class)->only(['destroy','index', 'store', 'create']);
    //管理者csvインポート
    Route::post('/users/csvImport',[AdminUserController::class, 'csvImport'])->name('admin.users.csvImport');
    
    //管理者ホーム画面
    Route::get('/admin/home',[AdminHomeController::class, 'home'])->name('admin.home');
    //管理者用各従業員勤務時間編集
    Route::get('/userTime/{user}/edit',[UserAttendanceTimeController::class, 'edit'])->name('userTime.edit');
    Route::patch('/userTime/{user}/update',[UserAttendanceTimeController::class, 'update'])->name('userTime.update');
    //出勤中
    Route::resource('/atwork',AtworkController::class)->only(['index']);
    //退勤者リスト
    Route::resource('/leaving',LeavingController::class)->only(['index']);
  
});
