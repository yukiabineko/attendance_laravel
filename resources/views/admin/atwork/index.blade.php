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
      @if ( $device == 'pc')
          @include('pc/admin/atwork/index')
      @else
           @include('mobile/admin/atwork/index')
      @endif
    </main>

@endsection