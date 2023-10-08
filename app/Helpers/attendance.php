<?php declare(strict_types=1);

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