@extends('general.app')

@section('title')
   管理者トップページ
@endsection

@section('css')
  
@endsection

@section('contents')
 <main>
   @include('share/flash')
   @include('share/errors')
   <main class="admin-top-container">
     <section class="text-center h2 fw-bold mt-5">管理者トップページ</section>
     
     <!-- メニューパネル -->
     <div class="admin-top-panels">

     </div>
   </main>
  

 </main>
    
@endsection