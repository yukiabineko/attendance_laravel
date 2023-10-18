@extends('general.app')

@section('title')
   {{ Auth::user()->name}}さん勤怠編集ページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/general/users/show.css')}}">
@endsection

@section('js')
    <script src="{{ asset('js/attendances/edit.js')}}"></script>
@endsection

@section('contents')
    <!-- メイン -->
    <main class="home-main">
      @include('share/flash')
      @include('share/errors')
      <section class="text-center h2 fw-bold mt-5">勤怠編集ページ</section>

      
      <!-- 勤怠編集ボタン -->
      <div class="action-btns">
        <a href="{{ route('attendances.edit', $user)}}" class="btn btn-success btn-lg">勤怠編集</a>
      </div>
      

      <!-- 勤怠表編集フォーム -->
      <form 
        action="{{ route('attendances.update', [ 'user' => $user, 'date' => $attendances[0]->worked_on ])}}"
        method="post">
        @csrf
        @method('patch')
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
                    <!-- 勤怠のid -->
                    <input type="hidden" name="attendance_id[]" value="{{ $attendance->id }}">
                    <!-- 勤怠日 -->
                    <input type="hidden" name="worked_on[]" value="{{ $attendance->worked_on }}">
                    <!-- 月パラメーター -->
                    <input type="hidden" name="date" value="{{ $date }}">

                  </tr>
              @endforeach
        </table>
        <!-- ボタン -->
        <div class="d-flex aligns-items-center justify-content-center mt-5 gap-2">
           <a href="{{ route('users.show',[
              'user' => Auth::user(),
              'date' => Request::get('date')
            ]) }}" 
            class="btn btn-default btn-lg border">戻る</a>
           <button type="submit" class="btn btn-success btn-lg">編集する</button>
        </div>
      </form>
    </main>

@endsection