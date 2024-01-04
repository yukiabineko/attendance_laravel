<section class="atwork-container">
        <div class="update mb-1">
          <a href="{{ route('atwork.index')}}" class="btn btn-primary">更新</a>
        </div>
        @if ( count( $attendances) > 0)
            <table class="atwork-table table table-bordered table-striped">
              <thead>
                <tr>
                  <th>出勤者名</th>
                  <th>契約出勤時間</th>
                  <th>契約退勤時間</th>
                  <th>実出勤時間</th>
                  <th>現在実労働時間</th>
                  <th>残り時間</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attendances as $attendance)
                  <tr>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->start_time}}</td>
                    <td>{{ $attendance->finish_time }}</td>
                    <td id="started_at_{{ $attendance->id }}" class="started_at">{{ date('H:i', strtotime( $attendance->started_at) ) }}</td>
                    <td class="work_times"></td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        @else
            <div class="empty">現在出勤者はいません。</div>
        @endif
        
      </section>