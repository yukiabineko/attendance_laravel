@extends('general.app')

@section('title')
   {{ Auth::user()->name}}さんページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/general/users/show.css')}}">
@endsection

@section('contents')
    <!-- メイン -->
    <main class="home-main">
      <section class="text-center h2 fw-bold mt-5">{{ Auth::user()->name }}さんページ</section>

      <!-- 会員情報 -->
      <div class="container">
        <div class="row">
          <div class="col-8 offset-2">
            <!-- 会員情報 -->
            <table class="table table-bordered mt-5">
              <tbody>
                <tr>
                  <td>会員名: {{ $user->name }}</td>
                  <td>メールアドレス: {{ $user->email }}</td>
                </tr>
                <tr>
                  <td class="w-50">出勤時間: {{ $user->start_time }}</td>
                  <td>退勤時間: {{ $user->finish_time }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- 勤怠表 -->
      <table class="table table-bordered m-auto mt-5 attendance-table">
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
                <td>{{ date('m/d', strtotime( $attendance->worked_on ))}}</td>

                <!-- 曜日 -->
                <td>{{ $attendance->wk() }}</td>

                <!-- 出勤(データあるかで分岐) -->
                @if (!empty($attendance -> started_at) )
                    <td>{{ date('h', strtotime( $attendance->started_at))}}</td>
                    <td>{{ date('i', strtotime( $attendance->started_at))}}</td>
                @else
                   <td></td> 
                   <td></td>
                   <td>
                      <!-- 今日の日付けの場合出勤ボタンを表示 -->
                      @if ( date('Y-m-d') == date('Y-m-d', strtotime( $attendance->worked_on)))
                        <div class="w-100">
                          <form action="{{ route('startAttendance.update', $attendance)}}" method="post" class="d-grid gap-2 w-100">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-primary">出勤</button>
                          </form>
                        </div> 
                      @endif
                   </td>
                @endif
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
          @endforeach
        </tbody>
        <!-- テーブルフッター -->
        <tfoot>
           <tr>
             <td class="bg-light" colspan="3">合計労働時間</td>
             <td colspan="5"></td>
           </tr>
        </tfoot>
      </table>
      
    </main>

@endsection