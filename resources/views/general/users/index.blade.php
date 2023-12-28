@extends('general.app')

@section('title')
   従業員一覧
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main">
       @include('share/flash')
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5 mb-5">従業員一覧</section>
       @if ( $device == 'pc')
          @include('pc.admin.users.index')    
       @else
          @include('mobile.admin.users.index')     
       @endif  
       
    </main>

@endsection