<table class="mobile-attendance-edit-table">
  <thead>
    <tr>
      <th>日付</th>
      <th>出退勤時間</th>
      <th>在社時間</th>
    </tr>
  </thead> 
  <tbody>
    @foreach ($attendances as $attendance)
        <tr>
          <!-- 日付け -->
          <td>
            <div class="mobile-edait-attendance-day">{{ date('m/d', strtotime( $attendance->worked_on ))}}</div>
            <div class="mobile-edait-attendance-week">{{ $attendance->wk() }}</div>
          </td>

          <!-- 出退勤時間フォーム -->
          <td class="mobile-forms">
            <div class="form-title">出勤時間</div>
             <input 
                type="time" 
                name="started_at[]" 
                value="{{ $attendance->start_tm()}}" 
                class="start-form"
                id="start-{{ $attendance->id }}"
                {{ $attendance->future_check() == false? "readonly" : ""}}
              >
            <div class="form-title">退勤時間</div>
             <input 
              type="time" 
              name="finished_at[]" 
              value="{{ $attendance->finish_tm()}}" 
              class="end-form"
              id="end-{{ $attendance->id }}"
              {{ $attendance->future_check() == false? "readonly" : ""}}
              >
             <div class="form-title">備考</div>
             <textarea 
              name="context[]" 
              class="textarea" {{ old('contex', $attendance->context )}}
              {{ $attendance->future_check() == false? "readonly" : ""}}
            ></textarea>
          </td>
           <!-- 在社時間 -->
          <td class="align-middle totals" id="total-{{ $attendance->id }}">{{ $attendance-> work_tm() }}</td>
          <!-- 勤怠のid -->
          <input type="hidden" name="attendance_id[]" value="{{ $attendance->id }}">
          <!-- 勤怠日 -->
          <input type="hidden" name="worked_on[]" value="{{ $attendance->worked_on }}">
          <!-- 月パラメーター -->
          <input type="hidden" name="date" value="{{ $date }}">

        </tr>
    @endforeach
  </tbody>
 </table>
<!--------------------------------------------------------------------------------------->
 <!--  スタイル　 -->
 <style>
   .mobile-attendance-edit-table{
      border-collapse: collapse;
      background-color: #f9f9f9;
      width: 100%
   }
   .mobile-attendance-edit-table th{
      background-color: #e9dd55;
      border: 1px solid #c0c0c0;
      line-height: 3
   }
   .mobile-attendance-edit-table td{
      border: 1px solid #c0c0c0;
      vertical-align: middle;
   }
   .mobile-edait-attendance-week,
   .mobile-edait-attendance-day
   {
      font-weight: bold;
      text-align: center;
   }
   .mobile-edait-attendance-week{
      margin-top: 10px;
   }
   .mobile-forms{
      width: 70%;
   }
   
   .form-title{
    margin: 5px
   }
   .start-form,
   .end-form,
   textarea
   {
     border: 1px solid #e9e9e9;
     border-radius: 6px;
     line-height: 3.5;
     margin: 0 5px;
     width: calc(100% - 12px);
   }
   .end-form{
    margin-bottom: 10px;
   }
 </style>