<header class="header">
  <!--アイコン -->
  <div class="app-name">勤怠管理システム</div>
  <!-- ハンバーガーメニュー -->
  <div class="menu">
    <input type="checkbox"  id="menu-check">
    <label for="menu-check" id="menu-box" class="menu-box">
       <span></span>
    </label>

    <!-- メニュー開いたときのバックグラウンド -->
    <div id="background" onclick="closeBackground()"></div>

    <!-- メニューリスト -->
    <div class="menu-lists">
      <div class="menu-list-wrapper">
         <h4 class="text-primary">メニュー</h4>
  <!------- ログイン時のレイアウト ------------------------------------>
         @if (Auth::check())
            <!-- ログイン時のメニュー -->
            <div class="authentication">
               <div class="auth-user-name">{{ Auth::user()->name}}さん</div>
               <div class="auth-status">出勤前</div>
               <ul class="authentication-menu">
                  <li>
                    <a href="{{ route('users.show', Auth::user())}}">会員勤怠</a>
                  </li>

                  <li>
                    <a href="{{ route('users.edit', Auth::user())}}">会員情報編集</a>
                  </li>
              </ul>
            </div>
            <form action="{{ route('logout')}}" method="post" class="d-grid gap-2 w-100">
              @csrf
              <button type="submit" class="btn btn-danger">ログアウト</button>
            </form> 
  <!------- 未ログイン時のレイアウト ------------------------------------>
         @else
           <div class="d-grid gap-2 w-100">
             <a href="{{ route('login')}}" class="btn btn-success">ログイン</a> 
           </div>
         @endif
      </div>
    </div>

  </div>
  
</header>