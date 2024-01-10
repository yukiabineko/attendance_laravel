<?php declare(strict_types=1);

use App\Models\Attendance;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

if (! function_exists('total')) {
    /**
     * 合計労働時間
     */
    function total(object $attendances): float
    {
        $total = 0;
        foreach($attendances as $attence){
          $total += $attence->work_tm();
        }
        return $total;
    }
}
if (! function_exists('first_date')) {
  /**
   * 月初日
   */
  function first_date(object $attendances): string
  {
    return date('m/d', strtotime( $attendances->first()->worked_on));
  }
}
if (! function_exists('end_date')) {
  /**
   * 月末日
   */
  function end_date(object $attendances): string
  {
    return date('m/d', strtotime( $attendances->last()->worked_on));
  }
}
if (! function_exists('get_prev')) {
  /**
   * 特定の全月の初日取得
   */
  function get_prev(object $attendances): string
  {
    return date('Y-m-d',strtotime('-1 month'.date('Y-m-d',strtotime($attendances[0]->worked_on))) );
  }
}
if (! function_exists('get_next')) {
  /**
   * 特定の全月の初日取得
   */
  function get_next(object $attendances): string
  {
    return date('Y-m-d',strtotime('+1 month'.date('Y-m-d',strtotime($attendances[0]->worked_on))) );
  }
}
/**
 * 勤務状分岐
 */
if (!function_exists('working_status')) {
  /**
   * 勤務状況
   */
  function working_status() :array{
     $today = date('Y-m-d');
     $attendance = Attendance::where('worked_on', $today)
     ->where('user_id', Auth::id())
     ->first();
    
     if( empty($attendance->started_at) ){
        return ['status' => '出勤前', 'css' =>'bg-success'];
     }
     elseif( !empty( $attendance->started_at) && empty( $attendance->finished_at )){
        return ['status' => '出勤中', 'css' =>'bg-primary'];
     }
     elseif( !empty( $attendance->started_at) && !empty( $attendance->finished_at )){
      return ['status' => '退勤済', 'css' =>'bg-danger'];
   }
  }
}
/**
 * 勤怠日数
 */
if (!function_exists('attendance_days')) {
  /**
   * 勤務日数
   */
  function attendance_days(Collection $attendances): int{
     $attendance_count  = 0;

     foreach ($attendances as $attendance) {
        if( !empty( $attendance->started_at ) && !empty( $attendance->finished_at ) ){
           $attendance_count += 1;
        }
     }
    return $attendance_count;
  }
}
/**
 * 15分ごと
 */
if(!function_exists('every_15_minutes')){
  /**
   * 15分区切りの計算
   */
  function every_15_minutes() :string{
     $min = date('i');
     if( (int)$min < 15 ){
       return  "00";
     }
     elseif( (int)$min >=15 && (int)$min < 30 ){
        return "15";
     }
     elseif( (int)$min >=30 && (int)$min < 45 ){
        return "30";
     }
     elseif( (int)$min >= 45 ){
        return "45";
     }
    
  }
}
/************************************************ */
 /**
  * 実労働時間
  */
  if( !function_exists('actual_work')){
    function actual_work(string $start, string $finish) :string
    {
       $start_min = (int)date('H', strtotime( $start )) * 60 + (int)date('i',strtotime( $start ));
       $finish_min = (int)date('H', strtotime($finish)) * 60 + (int)date('i', strtotime($finish));
       $result = $finish_min - $start_min;
       //商
       $quotient = (string)($result  / 60);
       
       return $quotient."時間";

    }
  }
/****************************************************** */
/**
 * 残業時間(管理者用)
 */
if( !function_exists('overtime_working')){
   function overtime_working(
     string $start,
     string $finish,
     string $actual_start,
     string $actual_finish
    )
    {
      //契約開始時間
      $start_min = (int)date('H', strtotime($start)) * 60 + (int)date('i', strtotime($start));
      //契約終了時間
      $finish_min = (int)date('H', strtotime($finish)) * 60 + (int)date('i', strtotime($finish));
      //契約時間
      $contract = ($finish_min - $start_min) / 60;

      //実際の開始時間
      $actual_start_min = (int)date('H', strtotime($actual_start)) * 60 + (int)date('i', strtotime($actual_start));
      //実際終了時間
      $actual_finish_min = (int)date('H', strtotime($actual_finish)) * 60 + (int)date('i', strtotime($actual_finish));
      //実際の労働時間
      $actual_worktime = ( $actual_finish_min - $actual_start_min ) / 60;
     
      if( $contract > $actual_worktime ){
        return "/";
      }
      else{
        return ($actual_worktime - $contract)."時間";
      }


    }
}
