@extends('general.app')

@section('title')
   {{ $user->name }}さんページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/general/users/show.css')}}">
@endsection
@section('js')
    <script src="{{ asset('js/general/home.js')}}"></script>
    <script src="{{ asset('js/general/home-mobile.js')}}"></script>
   
@endsection

@section('contents')
    <!-- メイン -->
    <main class="home-main">
      @include('share/flash')
      <section class="text-center h2 fw-bold mt-5">{{ $user->name }}さんページ</section>

      <!-- 勤怠表 -->
      @if ( $device == 'pc')
          @include('pc.users.show')
      @else
          @include('mobile.users.show')
      @endif
    </main>
    <!--------------------------------------------------------------------->
    <!-- モーダル -->
    @if ( $device == 'pc')
        @include('pc.users.overtimeModal')    
    @else
        @include('mobile.users.overtimeModal')    
    @endif

@endsection