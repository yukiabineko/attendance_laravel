@extends('general.app')

@section('title')
   退勤者リスト
@endsection

@section('js')
   <script src="{{ asset('js/admin/atwork.js')}}"></script> 
@endsection


@section('contents')

@if ( $device == 'pc')
  @include('pc/admin/leaving/index')
@else
  @include('mobile/admin/leaving/index')
@endif


@endsection