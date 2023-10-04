<?php

use App\Http\Controllers\general\FinishAttendanceController;
use App\Http\Controllers\general\StartAttendanceController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});
Route::group(['middleware' =>['auth']], function(){
    Route::get('/home',[HomeController::class, 'home'])->name('home');
    Route::resource('startAttendance', StartAttendanceController::class)->only(['update']);
    Route::resource('finishAttendance', FinishAttendanceController::class)->only(['update']);
});
