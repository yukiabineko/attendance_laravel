<!-- 会員情報 -->
  <ul class="user-infos">
    <!-- 月切り替え -->
    <li>
       <div class="d-flex justify-content-between align-items-center w-100">
          <!--前の月へ移動 -->
          <a 
          href="{{ route('users.show',['user' => $user, 
          'date' => get_prev( $attendances ) ])}}" 
          class="btn btn-primary">←</a>

          <!-- 現在月情報 -->
          <div>{{ date('Y年m月d日', strtotime( $attendances[0]->worked_on ) )}}</div>

          <!--前の月へ移動 -->
          <a 
          href="{{ route('users.show',['user' => $user, 
          'date' => get_next( $attendances ) ])}}" 
          class="btn btn-primary">→</a>
      </div>
    </li>

    <!-- 名前 -->
    <li>会員名: {{ $user->name }}</li>

    <!-- メールアドレス -->
    <li>メールアドレス: {{ $user->email }}</li>

    <!-- 出退勤 -->
    <li>
      <div class="info-wrapper">
        <div class="info-item">初日: {{ first_date( $attendances )}} </div>
        <div class="info-item">末日: {{ end_date( $attendances )}}</div>
      </div>
    </li>

     <!-- 初日、末日 -->
    <li>
      <div class="info-wrapper">
        <div class="info-item">出勤時間: {{ $user->start_time }}</div>
        <div class="info-item">退勤時間: {{ $user->finish_time }}</div>
      </div>
    </li>

    <!-- 勤怠日数 -->
    <li>勤怠日数:{{ attendance_days( $attendances )}}</li>

  </ul>

  <!-- 勤怠編集ボタン -->
  @if ( Auth::user()->admin == 1)
      <div class="action-btns">
        <a 
          href="{{ route('attendances.edit', ['user' => $user, 'date' => date('Y-m-d',strtotime( $attendances[0]->worked_on) ) ])}}" 
          class="btn btn-success btn-lg">勤怠編集</a>
      </div> 
  @endif
 
    
<!--------------------------勤怠--------------------------------------------->
<table class="home-table">
  <thead>
    <!-- テーブルヘッダー -->
    <tr>
      <th class="mobile-title">日付</th>
      <th colspan="8" class="mobile-title">内容</th>
    </tr>
  </thead>
  <!-- テーブル内容 -->
  <tbody>
    @foreach ($attendances as $attendance)
       <!-- １段目 -->
        <tr>
          <!-- 日付け -->
          <td rowspan="14" class="mobile-title">
             <div class="home-contents-day">{{ date('m/d', strtotime( $attendance->worked_on )) }}</div>
             <div class="home-contents-week">({{ $attendance->wk() }})</div>
             <div class="home-contents-overtime">
                <button 
                  type="button" 
                  class="btn btn-primary" 
                  onclick="overTimeDataMobile(this, {{$attendance->id }})">残業申請</button>
             </div>
          </td>
          <td colspan="7" class="mobile-title">【実績】</td>
        </tr>

      <!-- 2段目 -->
        <tr>
          <td colspan="3" class="mobile-title">出勤時間</td>
          <td colspan="3" class="mobile-title">退勤時間</td>
          <td rowspan="2" class="mobile-title">在社時間</td>
        </tr>

      <!-- 3段目 -->
      <tr>
        <td class="mobile-title">時</td>
        <td class="mobile-title">分</td>
        <td class="mobile-title"></td>
        <td class="mobile-title">時</td>
        <td class="mobile-title">分</td>
        <td class="mobile-title"></td>
        <td colspan="2" class="mobile-title"></td>
      </tr>
<!------------------------------------------------------------------------------------------>
      <!-- 4段目出勤、退勤実績 -->
      <tr>
         <!-- 出勤(データあるかで分岐) -->
            @if (!empty($attendance -> started_at) )
              <td>{{ date('H', strtotime( $attendance->started_at))}}</td>
              <td>{{ date('i', strtotime( $attendance->started_at))}}</td>
              <td></td>
            @else
                <td></td> 
                <td></td>
                <td>
                  <!-- 今日の日付けの場合出勤ボタンを表示 -->
                  @if ( date('Y-m-d') == date('Y-m-d', strtotime( $attendance->worked_on)) && Auth::id() == $user->id )
                    <div class="w-100">
                      <form action="{{ route('startAttendance.update', $attendance)}}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                        <button type="submit" class="btn btn-primary">出勤</button>
                      </form>
                    </div> 
                  @endif
                </td>
            @endif
         <!-- 退勤（データあるかで分岐 ) -->
            @if ( !empty($attendance -> started_at ) && !empty($attendance -> finished_at ) )
                <td>{{ date('H', strtotime( $attendance->finished_at))}}</td>
                <td>{{ date('i', strtotime( $attendance->finished_at))}}</td>
                <td></td>
            @else
                <td></td> 
                <td></td>
                <!-- 当日で、出勤してるか、出勤してるが退勤していないかで分岐 -->
                <td>
                  @if ( date('Y-m-d') == date('Y-m-d', strtotime( $attendance->worked_on)) && Auth::id() == $user->id
                        && !empty($attendance -> started_at )
                        && empty($attendance -> finished_at ))

                    <form action="{{ route('finishAttendance.update', $attendance)}}" method="post" class="d-grid gap-2">
                      @csrf
                      @method('patch')
                      <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                      <button type="submit" class="btn btn-success">退勤</button>
                    </form>
                  @endif
                </td>
            @endif
          <!--  在社時間 -->
            <td>{{ $attendance-> work_tm() }}</td>
      </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
    <!-- 5段目 -->
    <!--  備考 -->
    <tr>
      <td colspan="7" class="mobile-title">備考</td>
    </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
    <!-- 6段目 -->
    <!--  備考 -->
    <tr>
      <td colspan="7">{{ $attendance->note }}</td>
    </tr>
<!------------------------------------------------------------------------------------------------------------------------------->
    <!-- 7段目所定勤務時間ヘッダー -->
    <tr>
      <td colspan="7" class="mobile-title">【所定勤務時間】</td>
    </tr>
    
    <!-- 8段目 終了予定、時間外時間ヘッダー -->
    <tr>
      <td colspan="2" class="mobile-title">終了予定時間</td>
      <td colspan="6" rowspan="2" class="mobile-title">時間外時間</td>
    </tr>

    <!-- 9段目 終了予定時　分 -->
    <tr>
      <td class="mobile-title">時</td>
      <td class="mobile-title">分</td>
    </tr>

    <!-- 10段目 終了予定、時間外時間 -->
    <tr>
      <td>
         @if (isset( $attendance->end_schedule))
            {{ date('H', strtotime( $attendance->end_schedule ))}} 
         @endif
      </td>
      <td>
         @if (isset( $attendance->end_schedule))
          {{ date('i', strtotime( $attendance->end_schedule ))}} 
         @endif
      </td>

      <td colspan="5"></td>
    </tr>

     <!-- 11段目 業務処理内容ヘッダー -->
     <tr>
       <td colspan="7" class="mobile-title">業務処理内容</td>
     </tr>

    <!-- 12段目 業務処理内容内容 -->
     <tr>
       <td colspan="7">{{ $attendance->context }}</td>
     </tr>

     <!-- 13段目 指示者確認ヘッダー -->
     <tr>
       <td colspan="7" class="mobile-title">指示者確認㊞</td>
     </tr>

    <!-- 14段目 指示者確認内容 -->
     <tr>
       <td colspan="7">
        @if ( $attendance->overtime_approval == 1)
          {{ $attendance->getSuperiorName()}}に<br>残業申請中
        @endif
       </td>
     </tr>
    
   
    @endforeach
  </tbody>
  <!-- テーブルフッター -->
  <tfoot>
      <tr>
        <td class="bg-light" colspan="3">合計労働時間</td>
        <td colspan="7" class="text-center">{{ total( $attendances )}}時間</td>
     </tr>
  </tfoot>
</table>


<!---------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------->
<!-- スタイル -->
<style>
  .home-main{
    width: calc(100% - 2px);
    margin: 0 auto;
  }
  /***********************************************************************************/
  /**ユーザーテーブル**/
   .user-infos{
     width: 100%;
     margin: 3rem 0 0 0;
     padding: 0;
     list-style: none;
   }
   .user-infos li{
    border: 1px solid #c0c0c0;
    border-bottom: none;
    line-height: 2.5;
   }
   .user-infos li:last-child{
    border-bottom: 1px solid #c0c0c0;
   }
   .info-wrapper{
     display: flex;
     align-items: center;
     justify-content: flex-start;
    
   }
   .info-item{
     width: 50%;
     
   }
   .info-item:nth-child(odd){
      border-right: 1px solid #c0c0c0;
   }


  /**********************************************************************************/
  /*勤怠テーブル*/
  .home-table{
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #c0c0c0;
    margin: 3rem auto;
  }
  .home-table thead{
    background-color: #c0c0c0;
  }
  .home-table tbody tr td{
    border: 1px solid #c0c0c0;
  }
  .mobile-title{
    background-color: #f6f6f6;
    color: darkblue;
    text-align: center
  }
  /*テーブル日付けの内容*/
  .home-contents-day{
    font-size: 1.3rem;
    letter-spacing: 0.02;
  }
  .home-contents-overtime{
    width: 90%;
    margin: 1rem auto;
  }
   .home-contents-overtime button{
      width: 100%;
   }
</style>