<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class User implements Rule
{
    private $start;     //=>引数として出勤時間

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $start)
    {
        $this->start = $start;
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

        $start_hour = (int)explode(':', $this->start)[0];
        $start_min = (int)explode(':', $this->start)[1];
        $start_num = $start_hour * 60 + $start_min;

        $finish_hour = (int)explode(':', $value)[0];
        $finish_min = (int)explode(':', $value)[1];
        $finish_num = $finish_hour * 60 + $finish_min;

        return $finish_num < $start_min;

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
