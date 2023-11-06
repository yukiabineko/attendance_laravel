@extends('general.app')

@section('title')
   従業員一覧
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
@endsection

@section('contents')
    <main class="auth-main">
       @include('share/errors')
       
       <section class="text-center h2 fw-bold mt-5 mb-5">従業員一覧</section>
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
                           <td>{{ $user->name }}</td>
                           <td>
                              <a href="mailto:{{ $user->email}}">{{ $user->email }}</a>
                           </td>
                           <td>{{ date('H:i', strtotime( $user->started_time  ))}}</td>
                           <td>{{ date('H:i', strtotime( $user->finish_time  ))}}</td>
                           <td>
                              <div class="d-flex gap-2 justifi-content-between align-items-center">
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
       
    </main>

@endsection