@extends('general.app')

@section('title')
   {{ $user->name}}さん勤務時間編集
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/userTime.css')}}">
@endsection

@section('contents')
    <main class="user-time-main">
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5">{{ $user->name }}さん勤務時間編集</section>
          <div class="user-time-container shadow p-3">
             <form action="{{ route('userTime.update', $user)}}" method="POST">
                @csrf
                @method('patch')

                <!-- 出勤時間 -->
                <div class="form-group">
                    <div class="form-text">出勤時間</div>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $user->start_time )}}">
                </div>

                <!-- 出勤時間 -->
                <div class="form-group">
                    <div class="form-text">退勤時間</div>
                    <input type="time" name="finish_time" class="form-control" value="{{ old('finish_time', $user->finish_time )}}">
                </div>

                <!-- 編集ボタン -->
                <div class="d-grid gap-2 mt-5">
                   <button type="submit" class="btn btn-success">勤務時間編集</button>
                </div>
             </form>
          </div>
       
    </main>

@endsection