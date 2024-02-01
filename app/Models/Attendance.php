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
        'context',
        'user_id',
        'end_schedule',
        'overtime_approval',
        'overtime_superior_id',
        'note'
    ];
    public function user(){
        return $this->belongsTo(User::class); 
    }
/******************************************************* */
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

            return $work_time;
        }
        return  null;
   }
/******************************************************** */
  /**
   * 出勤時間入力フォーム自動配置するための加工
   */
  public function start_tm() :string{
     return !empty( $this->started_at)? date('H:i', strtotime( $this->started_at )) : "";
  }
/********************************************************* */
  /**
   * 退勤時間入力フォーム自動配置するための加工
   */
  public function finish_tm(){
    return !empty( $this->finished_at)? date('H:i', strtotime( $this->finished_at )) : "";
  }

/******************************************************** */
  /**
   * ターゲットの日付けが現在の日から未来かどうか？
   */
  public function future_check() :bool{
    $now = date('Y-m-d');
    $target = date('Y-m-d', strtotime( $this->worked_on ));
    return $now >= $target? true : false;
  }
/************************************************************* */
  /**
   * 土日で日付のスタイル変更
   */
  public function ws() :string{
    $day_number = date('w', strtotime( $this->worked_on ));
    switch ($day_number) {
      case 6:
        return "text-primary fw-bold";
        break;
      case 0:
        return "text-danger fw-bold";
        break;
      
      default:
        return "text-dark fw-bold";
        break;
    }
  }
/**************************************************************************************** */ 
  /**
   * 申請先の上長のデータ抽出
   */
  public function getOvertimeSuperiorName() :string{
     $superior = User::where('id', $this->overtime_superior_id)->first();
     return $superior->name;
  }
/***************************************************************************************** */
 /**
  * 承認状況による色の分岐
  */
  public function overTimeColorStyle() :string{
    switch ( (int)$this->overtime_approval) {
      case 0:
        return "color:black";
        break;
      case 1:
        return "color:#6699FF;font-weight:bold";
        break;
      
      default:
        break;
    }
  }


}
