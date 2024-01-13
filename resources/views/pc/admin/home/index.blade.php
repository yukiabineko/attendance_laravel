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

         <!-- 出勤者リスト -->
         <div class="panel">
          <a href="{{ route('atwork.index')}}" class="panel-link">
            <img src="{{ asset('img/admin/atwork.svg')}}" alt="出勤者リスト" class="panel-img">
            出勤者リスト
          </a>
        </div>

         <!-- 退勤者リスト -->
         <div class="panel">
          <a href="{{route('leaving.index')}}" class="panel-link">
            <img src="{{ asset('img/admin/gohome.svg')}}" alt="退勤者一覧" class="panel-img">
            退勤者リスト
          </a>
        </div>
        
         <!-- ログアウト -->
         <div class="panel">
           <form action="{{ route('logout')}}" method="post" class="logout-panel">
             @csrf
             <button type="submit">
                <img src="{{ asset('img/admin/logout.svg')}}" alt="ユーザー一覧" class="panel-img">
                ログアウト
             </button>
           </form>
        </div>

     </div>
 </main>
  