<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class MonthAuthController extends Controller
{
    /**************************************************** */
    /**
     * 一ヶ月申請処理
     */
    public function update(Request $request)
    {
        $month = date('Y-m', strtotime( $request->month ));
       
        $last = (int)date('d',strtotime(date('Y-m-t', strtotime( $month ) )));
    

        $target_dates = [];

        //該当する日つけの抽出
        for( $i = 1; $i<= $last; $i++ ){
            $target_date = date('Y-m-d', strtotime( $month."-".$i ) );
            \array_push($target_dates, $target_date);
        }

        //関連レコード抽出(一ヶ月)
        $target_records = Attendance::whereIn('worked_on', $target_dates)->where('user_id', $request->user_id)->get();
        //関連する一ヶ月のレコードの更新
        foreach($target_records as $target){
           if(!empty( $target->started_at ) && !empty( $target->finished_at ) ){
                $target->update([
                    'month_approval' => 1,
                    'month_superior_id' => $request->superior_id
                ]);
           }
        }
      return redirect( route('users.show',['user' => \Auth::user(), 'date' => $target_dates[0]]))->with('flash', '申請しました。');
    }
}
