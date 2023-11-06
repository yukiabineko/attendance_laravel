<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
      $user = \Auth::user();
      return $user->admin == 0 ? redirect( route('users.show', $user)) : redirect(route('admin.home'));
    }
}
