<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class attendance_not_finish implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    
       //出勤時間が入力済みで退勤時間が入力されてない場合のバリデーション
       $flag = 1;
       $starts = $this->request->started_at;
       $now = date('Y-m-d');

       foreach ($this->request->finished_at as $i => $finish) {
         $worked_on = date('Y-m-d',strtotime(  $this->request->worked_on[$i] ));
         $start = $starts[$i];
         if( $worked_on != $now && !empty( $start) && empty( $finish)){ $flag = 0; }

       }//end foreach
       return $flag == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '退勤時間が入力されていない項目があります。';
    }
}
