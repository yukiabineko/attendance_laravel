<ul class="user-lists">
  @foreach ($users as $user)
    <li class="user-list">
      <!-- 会員名　 -->
      <div class="name">{{ $user->name }}</div>
      
      <!-- 削除 -->
      <form action="{{ route('users.destroy',$user) }}" method="post" class="users-delete-form">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-primary">削除</button>
      </form>

      <!-- 編集 -->
      <form action="{{ route('users.update', $user)}}" method="post" class="users-edit-form">
         @csrf
         @method('update')

         <!--  編集ボタンのエリア -->
         <div class="btn-form">
            <button type="submit" class="btn btn-primary">編集</button>
         </div>

         <!-- 隠れているエリア -->
         <div class="user-hidden-erea">
           <!-- 会員名 -->
           <div class="form-group">
             <div class="form-title">名前</div>
             <input type="text" name="name" class="form-control">
           </div>

           <!-- メールアドレス -->
           <div class="form-group">
             <div class="form-title">メールアドレス</div>
             <input type="text" name="email" class="form-control">
           </div>

           <!-- 所属 -->
           <div class="form-group">
             <div class="form-title">所属</div>
             <input type="text" name="affiliation" class="form-control">
           </div>

            <!-- 社員番号 -->
            <div class="form-group">
              <div class="form-title">社員番号</div>
              <input type="number" name="employee_number" class="form-control">
            </div>

            <!-- パスワード -->
            <div class="form-group">
              <div class="form-title">パスワード</div>
              <input type="password" name="password" class="form-control">
            </div>

            <!-- パスワード確認 -->
            <div class="form-group">
              <div class="form-title">パスワード確認</div>
              <input type="password" name="password_confirmation" class="form-control">
            </div>

            <!-- 契約労働時間 -->
            <div class="form-group">
              <div class="form-title">契約労働時間</div>
              <input type="time" name="base_time" class="form-control">
            </div>

            <!-- 契約開始時間 -->
            <div class="form-group">
              <div class="form-title">契約開始時間</div>
              <input type="time" name="start_time" class="form-control">
            </div>

             <!-- 契約終了時間 -->
            <div class="form-group">
              <div class="form-title">契約開始時間</div>
              <input type="time" name=" finish_time   " class="form-control">
            </div>

            <!-- 編集ボタン -->
             <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">編集する</button>
             </div>
         </div>
       
      </form>
    </li>    
  @endforeach
</ul>