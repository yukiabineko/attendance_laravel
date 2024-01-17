
<!-- csvインポート -->
<div class="csv-import">
   <form action="{{ route('admin.users.csvImport')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="csv-forms">
        <label for="csv-file">ファイル選択</label>
        <span class="csv-file-text"></span>
        <input type="file" name="file" id="csv-file">
      </div>

      <div class="submit-btn">
        <button type="submit" class="btn btn-primary">csvインポート</button>
      </div>
   </form>
</div>

<!----------------------------------------------------------------->
<!-- 会員一覧 -->
<ul class="user-lists">
  @foreach ($users as $user)
    <li class="user-list">
      <!-- 会員名　 -->
      <div class="name">{{ $user->name }}</div>
      
      <!-- 削除 -->
      <form action="{{ route('users.destroy',$user) }}" method="post" class="users-delete-form">
          @csrf
          @method('delete')
          |&ensp;<button type="submit" class="btn btn-primary">削除</button>
      </form>

      <!-- 編集 -->
      <form action="{{ route('users.update',$user)}}" method="post" class="users-edit-form">
         @csrf
         @method('PATCH')

         <!--  編集ボタンのエリア -->
         <div class="btn-form">
            <button type="button" class="edit-btn btn btn-primary btn-lg">編集</button>
         </div>

        <!-- 隠れているフォーム -->
         <div class="user-hidden-erea" data-hidden="0">
            <div class="form-main">
              <!-- 会員名 -->
              <div class="form-group">
                <div class="form-title">名前</div>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name )}}">
              </div>

              <!-- メールアドレス -->
              <div class="form-group">
                <div class="form-title">メールアドレス</div>
                <input type="text" name="email" class="form-control" value="{{ old('email', $user->email )}}">
              </div>

              <!-- 所属 -->
              <div class="form-group">
                <div class="form-title">所属</div>
                <input type="text" name="affiliation" class="form-control" value="{{ old('affiliation', $user->affiliation )}}">
              </div>

                <!-- 社員番号 -->
                <div class="form-group">
                  <div class="form-title">社員番号</div>
                  <input type="number" name="employee_number" class="form-control" value="{{ old('employee_number', $user->employee_number )}}" >
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
                  <input type="time" name="base_time" class="form-control" value="{{ old('base_time', $user->base_time )}}">
                </div>

                <!-- 契約開始時間 -->
                <div class="form-group">
                  <div class="form-title">契約開始時間</div>
                  <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $user->start_time)}}">
                </div>

                <!-- 契約終了時間 -->
                <div class="form-group">
                  <div class="form-title">契約開始時間</div>
                  <input type="time" name="finish_time" class="form-control" value="{{ old('finish_time', $user->finish_time)}}">
                </div>

                <!-- 編集ボタン -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">編集する</button>
                </div>
            </div>
         </div>
      </form>
    </li>    
  @endforeach
</ul>
<!------------------------------------------------------------------------>
<!-- スタイル -->
<style>
  /**csv**/
  .csv-import{
    width: 90%;
    margin: 2.5rem auto 0;
  }
  #csv-file{
    display: none;
  }
  .csv-forms{
    align-items: center;
    display: flex;
    width: 30%;
    height: 50px;
    margin: 0;
  }
  .csv-file-text{
    background-color: white;
    border: 1px solid #c0c0c0;
    display: flex;
    align-items: center;
    font-size: 12px;
    width: 70%;
    height: 30px;
  }
  .csv-forms label{
    background-color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 30px;
    padding: 10px;
    width: 30%;
  }
  .submit-btn{
    width: 30%;
  }
  .submit-btn *{
    margin-top: .5rem;
    width: 100%;
  }

  /**リスト**/
  .user-lists{
    width: 90%;
    margin: 5% auto;
    list-style: none;
  }
  .user-list{
    margin-bottom: 1rem;
  }
  .btn-form{
    background-color: #c0c0c0;
    border-radius: 6px;
    padding: 1rem;
    position: relative;
    z-index: 2;
  }
  .user-hidden-erea{
    width: calc(100% - 2px);
    height: 0;
    background-color: white;
    border-left: 1px solid #c0c0c0;
    border-right: 1px solid #c0c0c0;
    border-bottom: 1px solid #c0c0c0;
    transition: .4s all;
    position: relative;
    opacity: 0;
    overflow: hidden;
    z-index: 1;
  }

  .form-main{
    width: 95%;
    background-color: #f9f9f9;
    margin: 0 auto;
    padding: 1rem 0;
  }
  .form-group{
    margin-bottom: 1rem;
  }
  footer{
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>