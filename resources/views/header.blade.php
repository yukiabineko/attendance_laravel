<header class="header">
  <!--アイコン -->
  <div class="app-name">勤怠管理システム</div>
  <!-- ハンバーガーメニュー -->
  <div class="menu">
    <input type="checkbox"  id="menu-check">
    <label for="menu-check" id="menu-box" class="menu-box">
       <span></span>
    </label>

    <!-- メニューリスト -->
    <div class="menu-lists">
      <div class="menu-list-wrapper">
         <h4 class="text-primary">メニュー</h4>
         @if (Auth::check())
            <form action="{{ route('logout')}}" method="post" class="d-grid gap-2 w-100">
              @csrf
              <button type="submit" class="btn btn-danger">ログアウト</button>
            </form> 
         @else
           <div class="d-grid gap-2 w-100">
             <a href="{{ route('login')}}" class="btn btn-success">ログイン</a> 
           </div>
         @endif
      </div>
    </div>

  </div>
  
</header>