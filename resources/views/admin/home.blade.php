@extends('general.app')

@section('title')
   管理者トップページ
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin/top.css')}}">
@endsection

@section('contents')
 <main>
   @include('share/flash')
   @include('share/errors')
   @if ( $device == 'pc')
       @include('pc/admin/home/index')
   @else
       @include('mobile/admin/home/index')
   @endif
   

 </main>
    
@endsection