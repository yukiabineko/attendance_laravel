<dl class="mobile-user-lists">
   <dt>従業員一覧</dt>
   @foreach ($users as $user)
      <!-- ID -->
      <dd>
        <div class="info-group">
          <div class="title">ID</div>
          <div class="content"> {{ $user->id }}</div>
        </div>
      <!-- 従業員名 -->
        <div class="info-group">
          <div class="title">名前</div>
          <div class="content">
             <a href="{{ route('users.show',$user)}}"> {{ $user->name }}</a>
          </div>
        </div>
       <!-- メールアドレス -->
        <div class="info-group">
          <div class="title">メールアドレス</div>
          <div class="content">{{ $user->email }}</div>
        </div>
       <!-- 出退勤時間 -->
        <div class="info-time">
          <!-- 出勤 -->
          <div class="start">
             <strong>出勤時間</strong>
             <div class="content">{{ date('H:i', strtotime( $user->started_time  ))}}</div>
          </div>
          <!-- 退勤 -->
          <div class="end">
             <strong>退勤時間</strong>
             <div class="content">{{ date('H:i', strtotime( $user->finish_time  ))}}</div>
          </div>
        </div> 
      <!-- ボタン -->
        <div class="buttons">
           <a href="{{ route('userTime.edit', $user)}}" class="mbtn time-btn">勤務時間</a>
           <a href="{{ route('users.edit', $user)}}" class="mbtn edit-btn">編集</a>
           <form action="{{ route('users.destroy', $user)}}" class="mbtn" method="POST">
              @csrf
              @method('delete')
              <button class="mbtn del-btn">削除</button>
           </form>
        </div>                    
      </dd>        
   @endforeach
  </dl>
  <!------------------------------------------------------------------------------------------>
  <!-- スタイル -->
  <style>
    .mobile-user-lists{
      background-color: rgb(255, 252, 252);
    }
    .mobile-user-lists dd{
      background-color: white;
      border: 1px solid #c0c0c0;
      margin: 0 auto 2.5rem;
      width: calc(100% - 2px);
    }
    .info-group{
      width: 100%;
    }
    .info-group .title, strong
    {
      background-color: #f0f0f0;
      display: block;
      font-weight: bold;
      font-size: .8rem;
      line-height: 2;
      width: 100%
    }
    .content{
      line-height: 2.1;
    }
    .buttons{
      align-items: center;
      display: flex;
      justify-content: space-between;
      margin-bottom: .8rem;
      gap: .5rem;
      width: 100%;
    }
    .mbtn{
       align-items: center;
       background-color: blue;
       border-radius: 4px;
       color: white;
       display: flex;
       font-size: .5rem;
       justify-content: center;
       line-height: 4;
       text-decoration: none;
       width: calc(100% / 3 - .5rem);
    }
    .time-btn{
      background-color: #6699FF;
    }
    .edit-btn{
      background-color: rgb(54, 135, 54);
    }
    .del-btn{
      background-color: red;
      width: 100%;
    }
  </style>