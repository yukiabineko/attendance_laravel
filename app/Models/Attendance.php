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

}
