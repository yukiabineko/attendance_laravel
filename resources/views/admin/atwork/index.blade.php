@extends('general.app')

@section('title')
   出勤者リスト
@endsection

@section('js')
   <script src="{{ asset('js/admin/atwork.js')}}"></script> 
@endsection


@section('contents')
<!--------------------------------------------------------->
<!-- スタイル -->
    <style>
      .atwork-main{
        widows: 100%;
      }
      .atwork-container{
        width: 95%;
        margin: 2rem auto;
      
      }
      .atwork-table, .update{
        width: 95%;
        margin: 0 auto;
      }
      .empty{
        width: 95%;
        align-items: center;
        aspect-ratio: 3 / 1;
        background-color: #f9f9f9;
        box-shadow: 1px 2px 1px 2px #f0f0f0;
        display: flex;
        font-size: 18px;
        font-weight: bold;
        margin: 0 auto;
        justify-content: center;
      }
    </style>
<!---------------------------------------------------------->
<!-- html -->
    <main class="atwork-main">
      <section class="text-center h2 fw-bold mt-5">現在出勤者リスト</section>
      <section class="atwork-container">
        <div class="update mb-1">
          <a href="{{ route('atwork.index')}}" class="btn btn-primary">更新</a>
        </div>
        @if ( count( $attendances) > 0)
            <table class="atwork-table table table-bordered table-striped">
              <thead>
                <tr>
                  <th>出勤者名</th>
                  <th>契約出勤時間</th>
                  <th>契約退勤時間</th>
                  <th>実出勤時間</th>
                  <th>現在実労働時間</th>
                  <th>残り時間</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attendances as $attendance)
                  <tr>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->start_time}}</td>
                    <td>{{ $attendance->finish_time }}</td>
                    <td id="started_at_{{ $attendance->id }}" class="started_at">{{ date('H:i', strtotime( $attendance->started_at) ) }}</td>
                    <td class="work_times"></td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        @else
            <div class="empty">現在出勤者はいません。</div>
        @endif
        
      </section>
    </main>

@endsection