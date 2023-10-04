@extends('general.app')

@section('title')
   新規会員登録
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main overflow-hidden">
       @include('share/errors')

       <section class="text-center h2 fw-bold mt-5">ログイン</section>
       <div class="container">
          <div class="row">
            <div class="{{ $device == "mobile"? "col-12" : "col-md-8 offset-2" }}">
              <form action="{{ route('login')}}" method="post" class="p-4 shadow mt-3 bg-light">
                @csrf
          
                <!-- メールアドレス -->
                <div class="form-group pt-3">
                  <div class="form-title">メールアドレス <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="email" name="email" class="form-control" value="{{ old('email')}}">
                </div>

                <!-- パスワード -->
                <div class="form-group pt-3">
                  <div class="form-title">パスワード <span class="form-info text-danger">(*必須です)</span></div>
                  <input type="password" name="password" class="form-control" >
                </div>


                <div class="d-grid g-2 pt-5 pb-4">
                   <button type="submit" class="btn btn-primary">ログインする</button>
                   <a href="{{ route('register')}}" class="mt-2 fw-bold">新規登録ページへ</a>
                </div>
              </form>
            </div>
          </div>
       </div>
       
    </main>

@endsection