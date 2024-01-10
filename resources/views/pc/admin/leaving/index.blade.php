<!--------------------------------------------------------->
<!-- スタイル -->
    <style>
      .empty{
        width: 95%;
        align-items: center;
        aspect-ratio: 3 / 1;
        background-color: #f9f9f9;
        box-shadow: 1px 2px 1px 2px #f0f0f0;
        display: flex;
        font-size: 18px;
        font-weight: bold;
        margin: 0 auto;
        justify-content: center;
      }
    </style>
<!---------------------------------------------------------->
<!-- html -->
    <main class="leaving-main">
      <section class="text-center h2 fw-bold mt-5">退勤者リスト</section>
      <section class="leaving-container">
        @if ( count( $attendances) > 0 )
            <table class="atwork-table table table-bordered table-striped">
              <thead>
                <tr>
                  <th>退勤者名</th>
                  <th>契約出勤時間</th>
                  <th>契約退勤時間</th>
                  <th>実出勤時間</th>
                  <th>実退勤時間</th>
                  <th>実績</th>
                  <th>残業時間</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attendances as $attendance)
                  <tr>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->start_time}}</td>
                    <td>{{ $attendance->finish_time }}</td>
                    <td id="started_at_{{ $attendance->id }}" class="started_at">{{ date('H:i', strtotime( $attendance->started_at) ) }}</td>
                    <td id="finished_at_{{ $attendance->id }}" class="finished_at">{{ date('H:i', strtotime( $attendance->finished_at) ) }}</td>
                    <td>{{ actual_work($attendance->started_at, $attendance->finished_at) }}</td>
                    <td>{{ overtime_working(
                      $attendance->start_time,
                      $attendance->finish_time,
                      $attendance->started_at,
                      $attendance->finished_at
                    )}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table> 
        @else
            <div class="empty">現在退勤者はいません。</div>
        @endif
      </section>
    </main>