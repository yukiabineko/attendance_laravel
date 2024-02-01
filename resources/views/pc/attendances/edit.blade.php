<table class="table table-bordered m-auto  attendance-table">
  <thead class="bg-light text-center align-middle">
    <!-- ヘッダー1 -->
    <tr>
      <th>日付</th>
      <th>曜日</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>在社時間</th>
      <th>備考</th>
      <th>指示者確認㊞</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <!-- データ -->
    @foreach ($attendances as $attendance)
        <tr>
          <!-- 日付け -->
          <td>{{ date('m/d', strtotime( $attendance->worked_on ))}}</td>

          <!-- 曜日 -->
          <td>{{ $attendance->wk() }}</td>

          <!--出勤時間フォーム -->
          <td class="align-middle">
            <input 
              type="time" 
              name="started_at[]" 
              value="{{ $attendance->start_tm()}}" 
              class="form-control start-form"
              id="start-{{ $attendance->id }}"
                {{ $attendance->future_check() == false? "readonly" : ""}}
            >
          </td>

          <!--退勤時間フォーム -->
          <td class="align-middle">
            <input 
              type="time" 
              name="finished_at[]" 
              value="{{ $attendance->finish_tm()}}" 
              class="form-control end-form"
              id="end-{{ $attendance->id }}"
              {{ $attendance->future_check() == false? "readonly" : ""}}
              >
          </td>

          <!-- 在社時間 -->
          <td class="align-middle totals" id="total-{{ $attendance->id }}">{{ $attendance-> work_tm() }}</td>

          <!-- 備考欄 -->
          <td>
            <textarea 
              name="context[]" 
              class="form-control" {{ old('contex', $attendance->context )}}
              {{ $attendance->future_check() == false? "readonly" : ""}}
            ></textarea>
          </td>

          <!-- 指示者セレクト -->
          <td class="align-middle">
            <select name="superior_id" class="form-select" {{ $attendance->future_check() == false? "disabled" : ""}}>
              <option ></option>
              @foreach ($superiors as $superior)
                  <option value="{{ $superior->id }}">{{ $superior->name }}</option>
              @endforeach
            </select>
          </td>
         
          <!-- 勤怠のid -->
          <input type="hidden" name="attendance_id[]" value="{{ $attendance->id }}">
          <!-- 勤怠日 -->
          <input type="hidden" name="worked_on[]" value="{{ $attendance->worked_on }}">
          <!-- 月パラメーター -->
          <input type="hidden" name="date" value="{{ $date }}">

        </tr>
    @endforeach
    </table>