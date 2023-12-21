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

      
      
      <!-- 勤怠表編集フォーム -->
      <form 
        action="{{ route('attendances.update', [ 'user' => $user, 'date' => $attendances[0]->worked_on ])}}"
        method="post">
        @csrf
        @method('patch')
        <!-- テーブル -->
        @if ( $device == 'pc')
          @include('pc.attendances.edit')
        @else
          @include('mobile.attendances.edit')  
        @endif
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