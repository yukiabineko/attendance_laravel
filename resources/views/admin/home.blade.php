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
   <main class="admin-top-container">
     <section class="text-center h2 fw-bold mt-5">管理者トップページ</section>
     
     <!-- メニューパネル -->
     <div class="admin-top-panels">
        <!-- 従業員一覧 -->
        <div class="panel">
          <a href="{{ route('users.index')}}" class="panel-link">
            <img src="{{ asset('img/admin/user.svg')}}" alt="ユーザー一覧" class="panel-img">
            従業員一覧
          </a>
        </div>

        <!-- 従業員新規登録 -->
        <div class="panel">
          <a href="{{ route('users.create')}}" class="panel-link">
            <img src="{{ asset('img/admin/user-edit.svg')}}" alt="ユーザ登録" class="panel-img">
            従業員登録
          </a>
        </div>

         <!-- ログアウト -->
         <div class="panel">
          <a href="#" class="panel-link">
            <img src="{{ asset('img/admin/logout.svg')}}" alt="ユーザー一覧" class="panel-img">
            ログアウト
          </a>
        </div>

         <!-- 従業員一覧 -->
         <div class="panel">
          <a href="#" class="panel-link">
            <img src="{{ asset('img/admin/user.svg')}}" alt="ユーザー一覧" class="panel-img">
            従業員一覧
          </a>
        </div>

        <!-- 従業員新規登録 -->
        <div class="panel">
          <a href="#" class="panel-link">
            <img src="{{ asset('img/admin/user-edit.svg')}}" alt="ユーザー一覧" class="panel-img">
            従業員登録
          </a>
        </div>
        
         <!-- ログアウト -->
         <div class="panel">
          <a href="#" class="panel-link">
            <img src="{{ asset('img/admin/logout.svg')}}" alt="ユーザー一覧" class="panel-img">
            ログアウト
          </a>
        </div>



     </div>
   </main>
  

 </main>
    
@endsection