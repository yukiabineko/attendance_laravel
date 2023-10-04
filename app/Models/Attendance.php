<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable =[
        'worked_on',
        'started_at',
        'finished_at',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class); 
    }
/****************5*************************************** */
    /**
     * 曜日の取得
     */
    public function wk(){
       $weeks = ["日", "月", "火", "水", "木", "金", "土"];
       return $weeks[ (int)date('w', strtotime( $this->worked_on ))];
    }
/******************************************************** */
  /**
   * 在社時間の計算
   */
   public function work_tm(){
        if( !empty( $this->started_at) && !empty( $this->finished_at )){
            //出勤時間(分)
            $satrt_min = (int)date('H', strtotime( $this->started_at )) * 60 
            + (int)date('i', strtotime( $this->started_at ));

            //退勤時間(分)
            $end_min = (int)date('H', strtotime( $this->finished_at )) * 60 
                + (int)date('i', strtotime( $this->finished_at ));

            $work_time = (float)( ($end_min  - $satrt_min) / 60 );

            return floor( $work_time );
        }
        return  null;
   }
/******************************************************** */
}
