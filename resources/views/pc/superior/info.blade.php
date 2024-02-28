<!-- 上長アカウントでの表示 -->
@if ( Auth::user()->superior == 1 )
    <div class="superior-applys">
      <!-- 所属長承認(その月の勤怠の承認) -->
      <div class="superior-auth">
         <div class="apply-title" style={{ count( $overtimes) > 0? "color:red" : "" }}>
          【 所属長承認申請のお知らせ 】
           <a>{{ count( $onemonths) }}件</a>
         </div>
      </div>

      <!-- 勤怠変更申請 -->
      <div class="superior-auth">
        <div class="apply-title" style={{ count( $edits) > 0? "color:red" : "" }}>
          【 勤怠変更申請のお知らせ 】
            <a>{{ count( $edits) }}件</a>
        </div>
      </div>

     <!-- 残業申請のお知らせ -->
      <div class="superior-auth">
         <div class="apply-title" style={{ count( $overtimes) > 0? "color:red" : "" }}>
          【 残業申請のお知らせ 】
           <a>{{ count( $overtimes) }}件</a>
         </div>
      </div>

    


    </div>
@endif