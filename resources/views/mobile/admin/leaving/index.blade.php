<section class="atwork-container">
        <div class="update mb-1">
        </div>
        @if ( count( $attendances) > 0)
            <ul class="atwork-mobile-lists">
              @foreach ($attendances as $attendance)
              <li>
                <!-- 名前 -->
                <div class="alist-group">
                  <div class="atwork-title">退勤者名</div>
                  <div class="atwork-content">{{ $attendance->name }}</div>
                </div>
                <!-- 出勤時間 -->
                <div class="alist-group">
                  <div class="atwork-title">契約出勤時間</div>
                  <div class="atwork-content">{{ $attendance->start_time}}</div>
                </div>
                 <!-- 退勤時間 -->
                <div class="alist-group">
                  <div class="atwork-title">契約退勤時間</div>
                  <div class="atwork-content">{{ $attendance->finish_time }}</div>
                </div>
                <!-- 実労働時間  -->
                <div class="alist-group">
                  <div class="atwork-title">実退勤時間</div>
                  <div class="atwork-content" id="started_at_{{ $attendance->id }}">{{ date('H:i', strtotime( $attendance->finished_at) ) }}</div>
                </div>
                 <!-- 実績  -->
                <div class="alist-group">
                  <div class="atwork-title">実績</div>
                  <div class="work_times">{{ actual_work($attendance->started_at, $attendance->finished_at) }}</div>
                </div>
                 <!-- 残業時間  -->
                <div class="alist-group">
                  <div class="atwork-title">残業時間</div>
                  <div class="work_times">
                    {{ overtime_working(
                      $attendance->start_time,
                      $attendance->finish_time,
                      $attendance->started_at,
                      $attendance->finished_at
                    )}}
                  </div>
                </div>
              </li>
              @endforeach
            </ul>    
        @else
            <div class="empty">現在出勤者はいません。</div>
        @endif
   <div class="d-grid gap-2">
      <a href="{{ route('atwork.index')}}" class="btn btn-primary">更新</a>
   </div>
</section>
      <!--- スタイル -->
      <style>
        .atwork-container{
           width: 100vw;
           margin: 0 !important;
           padding: 0 !important;
        }
        .atwork-mobile-lists{
          background-color: #F9F9F9;
          display: block;
          margin: 0;
          margin-top: 1rem;
          padding: 2rem 0;
          list-style: none;
          width: 100%;
        }
        .atwork-mobile-lists li{
          line-height: 3;
          width: 100%;
        }
        .alist-group{
          display: flex;
          align-items: center;
          justify-content: space-between;
          width: 100%;
          background-color:#FFF;
          border-top: 1px solid #c0c0c0;
          border-left: 1px solid #c0c0c0;
          border-right: 1px solid #c0c0c0;
        }
        .alist-group:last-child{
          border-bottom:1px solid #c0c0c0;
        }
        .atwork-mobile-lists li{
          margin-bottom: 2.5rem;
        }

      </style>