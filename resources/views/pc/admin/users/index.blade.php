<div class="row">
      <div class="col-12">
          <!-- 一覧 -->
          <table class="table table-striped border">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>従業員名</th>
                  <th>メールアドレス</th>
                  <th>出勤時間</th>
                  <th>退勤時間</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>
                        <a href="{{ route('users.show',$user)}}"> {{ $user->name }}</a>
                      </td>
                      <td>
                        <a href="mailto:{{ $user->email}}">{{ $user->email }}</a>
                      </td>
                      <td>{{ date('H:i', strtotime( $user->started_time  ))}}</td>
                      <td>{{ date('H:i', strtotime( $user->finish_time  ))}}</td>
                      <td>
                        <div class="d-flex gap-2 justifi-content-between align-items-center">
                            <a href="{{ route('userTime.edit', $user)}}" class="btn btn-success w-25">勤務時間</a>
                            <a href="{{ route('users.edit', $user)}}" class="btn btn-success w-25">編集</a>
                            <form action="{{ route('users.destroy', $user)}}" class="w-25" method="POST">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger">削除</button>
                            </form>
                        </div>

                      </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
  </div>