<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
      return redirect( route('users.show', \Auth::user()));
    }
}
