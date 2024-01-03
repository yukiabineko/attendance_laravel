@extends('general.app')

@section('title')
   新規会員登録(管理者)
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main">
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5">管理者用新規会員登録</section>
       <div class="container">
          <div class="row">
            <div class="{{ $device == "mobile"? "col-12" : "col-md-8 offset-2" }}">
              @include('share/userForm',['edit' => false])
            </div>
          </div>
       </div>
    </main>
    @if ( $device == 'pc')
        @include('pc/admin/users/form')
    @else
        @include('mobile/admin/users/form')
    @endif

@endsection