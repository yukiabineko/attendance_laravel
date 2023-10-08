<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'start_time',
        'finish_time',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    /**
     * 初期の出勤日の作成
     */
    /************************************************************************************ */
    public function createAttendance( string $date = null ){
      $begin_date = isset( $date )? date('Y-m-01',strtotime( $date )) :  date('Y-m-01');;
      $last_date = isset( $date )? date('Y-m-t',strtotime( $date )) :  date('Y-m-t');;
      $attendances 
        = $this->attendances()
        ->where('worked_on', '>=', $begin_date)
        ->where('worked_on', '<=', $last_date)
        ->get();
       
        
      //関連日付け範囲
      for ($i = $begin_date; $i <= $last_date; $i = date('Y-m-d', strtotime($i . '+1 day'))) {
        $exist = 0;
        /**
         *ユーザーのレコードですでに同じ年月日があるか確認。なければ作成。
         */
        foreach($attendances as $attendance){
            if( $attendance->worked_on == $i){   //=>すでにその日付あらばステータス1にする。
                $exist = 1;
            }
        }
        if( $exist == 0){                       //=>存在しない場合レコード作成
            Attendance::create([
                'worked_on' => $i,
                'user_id' => $this->id
            ]);
         }
      }
    }
     /************************************************************************** */
    /**
     * 該当月のレコード取得
     */
    public function getAttendances(string $date = null){
        $begin_date = isset( $date )? date('Y-m-01',strtotime( $date )) :  date('Y-m-01');
        $last_date =isset( $date )? date('Y-m-t',strtotime( $date )) :  date('Y-m-t');;
        $attendances 
          = $this->attendances()
          ->where('worked_on', '>=', $begin_date)
          ->where('worked_on', '<=', $last_date)
          ->get();

        return $attendances;
    }
  
}
