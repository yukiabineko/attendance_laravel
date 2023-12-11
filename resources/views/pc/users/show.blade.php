<!-- 会員情報 -->
  <div class="container mb-5">
    <div class="row">
      <div class="{{ $device == "mobile"? "col-12" : "col-md-8 offset-2" }}">
        <!-- 会員情報 -->
        <table class="table table-bordered mt-5">
          <tbody>
            <tr>
              <td>
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
              <td colspan="2" class="align-middle">会員名: {{ $user->name }}</td>
              <td colspan="2" class="align-middle">メールアドレス: {{ $user->email }}</td>
            </tr>
            <tr>
              <td>出勤時間: {{ $user->start_time }}</td>
              <td>退勤時間: {{ $user->finish_time }}</td>
              <td>初日: {{ first_date( $attendances )}} </td>
              <td>末日: {{ end_date( $attendances )}}</td>
              <td>勤怠日数:{{ attendance_days( $attendances )}} </td>
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
    


<table class="table table-bordered m-auto  attendance-table">
        <thead class="bg-light text-center align-middle">
          <!-- ヘッダー1 -->
          <tr>
            <th rowspan="2">日付</th>
            <th rowspan="2">曜日</th>
            <th colspan="3">出勤時間</th>
            <th colspan="3">退勤時間</th>
            <th rowspan="2">在社時間</th>
            <th rowspan="2">備考</th>
          </tr>
           <!-- ヘッダー2 -->
           <tr>
            <th>時</th>
            <th>分</th>
            <th></th>
            <th>時</th>
            <th>分</th>
            <th></th>
           </tr>
        </thead>
        <tbody class="text-center">
          <!-- データ -->
          @foreach ($attendances as $attendance)
              <tr>
                <!-- 日付け -->
                <td class="{{ $attendance->ws() }}">{{ date('m/d', strtotime( $attendance->worked_on ))}}</td>

                <!-- 曜日 -->
                <td class="{{ $attendance->ws() }}">{{ $attendance->wk() }}</td>

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
                <td></td>
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