<header class="header">
  <!--アイコン -->
  <div class="app-name">勤怠管理システム</div>

  <!-- 管理者ログイン時の場合の表示 -->
  @if ( Auth::check() && Auth::user()->admin == 1 )
     <div class="text-warning font-weight-bold">管理者ログイン</div>
  @endif

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
                <!-- 管理者のログイン -->
                @if ( Auth::user()->admin == 1)
                   <div class="auth-user-name">管理者メニュー</div>
                    <ul class="authentication-menu">
                        <!-- 社員リスト -->
                        <li>
                          <a href="{{ route('users.index')}}">会員一覧</a>
                        </li>

                        <!-- 当日出勤中のリスト -->
                        <li>
                          <a href="#">出勤中リスト</a>
                        </li>

                         <!-- 退勤者リスト -->
                        <li>
                          <a href="#">本日退勤者</a>
                        </li>
                    </ul>

                <!-- 一般ユーザーのログイン -->
                @else
                   <div class="auth-user-name">{{ Auth::user()->name}}さん</div>
                   <div class="auth-status {{ working_status()['css']}}">{{ working_status()['status']}}</div>
                    <ul class="authentication-menu">
                        <li>
                          <a href="{{ route('users.show', Auth::user())}}">会員勤怠</a>
                        </li>

                        <li>
                          <a href="{{ route('users.edit', Auth::user())}}">会員情報編集</a>
                        </li>
                    </ul>
                @endif
              </div>
            <form action="{{ route('logout')}}" method="post" class="d-grid gap-2 w-100">
              @csrf
              <button type="submit" class="btn btn-danger">ログアウト</button>
            </form> 
  <!------- 未ログイン時のレイアウト ------------------------------------>
         @else
           <!-- 未認証時のエレメント -->
           <div class="unauthenticated">ログインしてください。</div>
           <div class="d-grid gap-2 w-100">
             <a href="{{ route('login')}}" class="btn btn-success">ログイン</a> 
           </div>
         @endif
      </div>
    </div>

  </div>
  
</header>