<?php

use App\Http\Controllers\general\AttendanceController;
use App\Http\Controllers\general\FinishAttendanceController;
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
    //ユーザープロフィール変更画面
    Route::resource('users', UserController::class)->only(['edit','update', 'index']);
});
