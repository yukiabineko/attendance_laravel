@extends('general.app')

@section('title')
   {{ Auth::user()->name}}さんページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
@endsection

@section('contents')
    <main class="home-main">
      <section class="text-center h2 fw-bold mt-5">{{ Auth::user()->name }}さんページ</section>
      
    </main>

@endsection