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

}
