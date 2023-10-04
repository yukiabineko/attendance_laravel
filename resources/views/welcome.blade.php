@extends('general.app')

@section('contents')
<main class="auth-main">
    @include('share/errors')

    <section class="text-center h2 fw-bold mt-5 mb-5">勤怠管理システム</section>
    <div class="container text-center mt-5">
      <a href="{{ route('login')}}" class="btn btn-primary mt-5">ログインしてください。</a>
    </div>
    
 </main>

@endsection