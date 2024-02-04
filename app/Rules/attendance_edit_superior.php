<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class attendance_edit_superior implements Rule
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
        //申請先を選択してるかのルール
        $flag = 1;
        $finishs = $this->request->finished_at;
        $superiors = $this->request->superior_id;
    

        foreach ($this->request->started_at as $i => $start) {
            $finish = $finishs[$i];
            $superior = $superiors[$i];

            if (!empty($start) && !empty($finish)) {
               if( !isset( $superior) ){
                  $flag = 0;
               }
                
            } //end if
        } //end foreach
        return $flag == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '申請先を選択してください。';
    }
}
