@extends('general.app')

@section('title')
   新規会員登録
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main">
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5">新規会員</section>
       <div class="container">
          <div class="row">
            <div class="col-md-8 offset-2">
              <form action="{{ route('register')}}" method="post" class="p-3 shadow mt-3 bg-light">
                @csrf
                <!-- 会員名 -->
                 <div class="form-group pt-3">
                   <div class="form-title">会員名 <span class="form-info text-danger">(*必須です)</span></div>
                   <input type="text" name="name" class="form-control" value="{{ old('name')}}" placeholder="会員名を入力してください。">
                 </div>

                <!-- メールアドレス -->
                <div class="form-group pt-3">
                  <div class="form-title">メールアドレス <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="email" name="email" class="form-control" value="{{ old('email')}}" placeholder="sample@example.com">
                </div>


                <!--　出勤時間 -->
                <div class="form-group pt-3">
                  <div class="form-title">出勤時間 <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="time" name="start_time" class="form-control" value="{{ old('start_time')}}" >
                </div>

                <!--　退勤時間 -->
                <div class="form-group pt-3">
                  <div class="form-title">退勤時間 <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="time" name="finish_time" class="form-control" value="{{ old('finish_time')}}" >
                </div>


                <!-- パスワード -->
                <div class="form-group pt-3">
                  <div class="form-title">パスワード <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="password" name="password" class="form-control"  placeholder="8文字以上で入力してください。">
                </div>

                 <!-- パスワード確認 -->
                 <div class="form-group pt-3">
                  <div class="form-title">パスワード確認 <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="password" name="password_confirmation" class="form-control"  placeholder="パスワード確認">
                </div>

                <div class="d-grid g-2 pt-5 pb-4">
                   <button type="submit" class="btn btn-primary">会員登録する</button>
                   <a href="{{ route('login')}}" class="mt-2 fw-bold">ログインページへ</a>
                </div>
              </form>
            </div>
          </div>
       </div>
       
    </main>

@endsection