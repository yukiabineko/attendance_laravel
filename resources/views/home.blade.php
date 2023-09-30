@extends('general.app')

@section('title')
   {{ Auth::user()->name}}さんページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
@endsection

@section('contents')
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
      <table class="table table-bordered">
        <thead>
          <th rowspan="2">日付</th>
        </thead>
      </table>
      
    </main>

@endsection