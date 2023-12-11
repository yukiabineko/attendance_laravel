<!-- 会員情報 -->
<div class="container mb-5">
  <div class="row">
    <div class="{{ $device == "mobile"? "col-12" : "col-md-8 offset-2" }}">
      <!-- 会員情報 -->
      <table class="table table-bordered mt-5">
        <tbody>
          <!-- 名前 -->
          <tr>
             <td colspan="2" class="align-middle">会員名: {{ $user->name }}</td>
          </tr>

          <!-- メールアドレス -->
          <tr>
             <td colspan="2" class="align-middle">メールアドレス: {{ $user->email }}</td>
          </tr>

          <!-- 出勤時間 -->
          <tr>
            <td>出勤時間: {{ $user->start_time }}</td>
            <td>退勤時間: {{ $user->finish_time }}</td>
          </tr>

          <!-- 初日、末日 -->
          <tr>
            <td>初日: {{ first_date( $attendances )}} </td>
            <td>末日: {{ end_date( $attendances )}}</td>
          </tr>

          <!-- 勤務時間 -->
          <tr>
            <td colspan="2">勤怠日数:{{ attendance_days( $attendances )}} </td>
          </tr>


          <!-- 月切り替え -->
          <tr>
            <td colspan="2">
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
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- 勤怠編集ボタン -->
<div class="action-btns">
  <a 
    href="{{ route('attendances.edit', ['user' => $user, 'date' => date('Y-m-d',strtotime( $attendances[0]->worked_on) ) ])}}" 
    class="btn btn-success btn-lg">勤怠編集</a>
</div>
      







<table class="usser-attendance-mobile">
  <thead>
    <tr>
      <th rowspan="3">日付</th>
      <th colspan="6">出退勤時間</th>
      <th rowspan="3">在社時間</th>
    </tr>

    <tr>
      <th colspan="3">出勤</th>
      <th colspan="3">退勤</th>
    </tr>

    <tr>
      <th>時</th>
      <th>分</th>
      <th></th>
      <th>時</th>
      <th>分</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($attendances as $attendance)
      <tr>
        <td class="{{ $attendance->ws() }}">
          <div class="day-data">
            <div class="day"> {{ date('m/d', strtotime( $attendance->worked_on ))}}</div>
            <div class="week">{{ $attendance->wk() }}</div>
          </div>
        </td>
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
                  <form action="{{ route('startAttendance.update', $attendance)}}" method="post" class="d-grid gap-2 w-100">
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
        <td>{{ $attendance-> work_tm() }}</td>
      </tr>
    @endforeach
   
  </tbody>
</table>

<style>
  .home-main{
    width: 100%;
    overflow: hidden;
  }
  .usser-attendance-mobile{
    border-collapse: collapse
    background-color: yellow;
    width: 100%;
  }
  .usser-attendance-mobile th,
  .usser-attendance-mobile td
  {
    border: 1px solid #c0c0c0;
    text-align: center;
  }
</style>