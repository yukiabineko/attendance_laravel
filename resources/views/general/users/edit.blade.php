@extends('general.app')

@section('title')
   {{ $user->name}}さん編集
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main">
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5">{{ $user->name }}さん編集</section>
       <div class="container">
          <div class="row">
            <div class="{{ $device == "mobile"? "col-12" : "col-md-8 offset-2" }}">
              @include('share/userForm',['edit' => true ])
            </div>
          </div>
       </div>
       
    </main>

@endsection