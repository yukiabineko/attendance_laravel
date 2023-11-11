 @if ( Auth::check() && Auth::user()->admin == 1)
  <form 
      action="{{ $edit? route('users.update', $user) : route('users.store')}}" 
      method="post" class="p-5  shadow mt-3 bg-light"
    >
 @else
  <form 
    action="{{ $edit? route('users.update', $user) : route('register')}}" 
    method="post" class="p-5  shadow mt-3 bg-light"
    >
 @endif
 
    @csrf
    @if ( $edit )
       @method('patch') 
    @endif
    <!-- 会員名 -->
     <div class="form-group pt-3">
       <div class="form-title">会員名 <span class="form-info text-danger">(*必須です)</span></div>
       <input 
         type="text"
         name="name"
         class="form-control" 
         value="{{ $edit? old('name', $user->name) : old('name') }}" 
         placeholder="会員名を入力してください。">
     </div>

    <!-- メールアドレス -->
    <div class="form-group pt-3">
      <div class="form-title">メールアドレス <span class="form-info text-danger">(*必須です)</span></div>
      <input 
        type="email" 
        name="email" 
        class="form-control" 
        value="{{ $edit? old('email', $user->email ) : old('email')}}" 
        placeholder="sample@example.com">
    </div>


    <!--　出勤時間 -->
    <div class="form-group pt-3">
      <div class="form-title">出勤時間 <span class="form-info text-danger">(*必須です)</span></div>
      <input 
       type="time" 
       name="start_time" 
       class="form-control" 
       value="{{ $edit? old('start_time', $user->start_time ) : old('start_time')}}" >
    </div>

    <!--　退勤時間 -->
    <div class="form-group pt-3">
      <div class="form-title">退勤時間 <span class="form-info text-danger">(*必須です)</span></div>
      <input 
        type="time" 
        name="finish_time" 
        class="form-control" 
        value="{{ $edit? old('finish_time', $user->finish_time ) : old('finish_time') }}" >
    </div>


    <!-- パスワード -->
    <div class="form-group pt-3">
      <div class="form-title">パスワード <span class="form-info text-danger">(*必須です)</span></div>
      <input type="password" name="password" class="form-control"  placeholder="8文字以上で入力してください。">
    </div>

     <!-- パスワード確認 -->
     <div class="form-group pt-3">
      <div class="form-title">パスワード確認 <span class="form-info text-danger">(*必須です)</span></div>
      <input type="password" name="password_confirmation" class="form-control"  placeholder="パスワード確認">
    </div>

    <div class="d-grid g-2 pt-5 pb-4">
       <button type="submit" class="btn {{ $edit? 'btn-success' : 'btn-primary'}}">
        {{ $edit? '編集する' : '会員登録する' }}
      </button>
      @if (Auth::check() && Auth::user()->admin == 1 )
          <a href="{{ route('admin.home')}}" class="mt-2 fw-bold">トップページへ</a>
      @else
        @if ( !$edit )
          <a href="{{ route('login')}}" class="mt-2 fw-bold">ログインページへ</a>
        @endif
      @endif
    
      
    </div>
  </form>