<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Attendance_time implements Rule
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
        //出勤時間が退勤時間より後にならないようにするルール
        $flag = 1;
        $finishs = $this->request->finished_at;
        
        foreach( $this->request->started_at as $i => $start ){
            $finish = $finishs[$i];
            
            if( !empty($start) && !empty($finish)){
                
                $start_hour = (int)explode(':', $start)[0];
                $start_min = (int)explode(':', $start)[1];
                $start_num = $start_hour * 60 + $start_min;

                $finish_hour = (int)explode(':', $finish)[0];
                $finish_min = (int)explode(':', $finish)[1];
                $finish_num = $finish_hour * 60 + $finish_min;
                if( $finish_num < $start_num){ $flag = 0;}
            }//end if
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
        return '退勤勤時間は出勤時間より後にする必要があります。';
    }
}
