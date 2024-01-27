<!-- 後ろのバックグラウンド -->
<div class="modal-back" onclick="overtimeModalClose()"></div>

<!-- モーダル -->
<div class="overtime-modal">
  <div class="overtime-modal-wrapper">
  <!---------------------------------------------------->
      <!-- モーダルヘッダー -->
      <div class="over-time-modal-header-wrapper">
           <div class="overtime-modal-header">
            <div class="overtime-modal-title">【 残業申請 】</div>
            <button class="overtime-modal-close" onclick="overtimeModalClose()">x</button>
          </div>
      </div>
     
  <!---------------------------------------------------->
      <!-- モーダルメインコンテンツ -->
      <div class="overtime-modal-contents bg-light">
        <form action="{{ route('overtimeModal.update')}}" method="post">
          @csrf
          @method('patch')
           <table class="table table-bordered">
              <thead class="overtime-thead">
                <tr>
                  <th>日付け</th>
                  <th>曜日</th>
                  <th>終了予定時間</th>
                  <th>翌日</th>
                  <th>業務処理内容</th>
                  <th>指示者確認㊞</th>
                </tr>
              </thead>
              <tbody>
                <tr id="overtimeModalTr">
                  <!--日付け -->
                  <td></td>

                  <!--曜日 -->
                  <td></td>

                  <!-- 時間 -->
                  <td class="time-td">
                    <select name="hour" id="hour-select"></select>
                    <select name="min" id="min-select">
                      <option value="0">0分</option>
                      <option value="15">15分</option>
                      <option value="0">45分</option>
                    </select>
                  </td>

                  <!-- 明日 -->
                  <td>
                    <input type="checkbox" name="tomorrow" id="tomorrow-check">
                  </td>

                  <!-- 業務処理内容 -->
                  <td>
                    <input type="text" name="process" class="form-control" id="process-form">
                  </td>

                  <!-- 上長 -->
                  <td>
                    <select name="superior" id="superior-select" class="form-select"></select>
                  </td>

                </tr>
              </tbody>
           </table>
           <div class="btn-wrapper d-grid gap-2">
              <button type="submit" class="btn btn-primary">変更を送信する</button>
           </div>
             <input type="hidden" name="worked_on" id="worked_on">
           <input type="hidden" name="user_id" id="user_id">
           <input type="hidden" name="approval" value="1">
        </form>
      </div>
      <!-- modal-contents finish -->
  </div>
</div>

<!-- スタイル -->
<style>
  /*モーダルバックレイヤー*/
 .modal-back{
    display: none;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 3;
  }
  .modal-back-show{
    display: block !important;
  }

  /**残業申請モーダル**/
  .overtime-modal{
    width: 70%;
    background: white;
    box-shadow: 0 3px 6px 2px #aaa;
    border-radius: 0 0 3px 3px;
    position: absolute;
    left: 50%;
    top: -200%;
    transition: .2s all ease-in;
    transform: translateX(-50%);
    z-index: 4;
  }
  
  .over-time-modal-header-wrapper{
    width: 60%;
    line-height: 3;
    margin-left: 39%;
  }
  .overtime-modal-header{
    align-items: center;
    display: flex;
    justify-content: space-between;
   
  }
  .overtime-modal-title{
    font-size: 18px;
  }
  .overtime-modal-close{
    background-color: transparent;
    font-size: 1.4rem;
  }
  .table{
    margin: 0 auto 2rem;
    width: 95%;

  }
 .overtime-thead tr th{
    text-align: center;
 }
 td{
  text-align: center;
 }
 .time-td{
   align-items: center;
   display: flex;
   justify-content: space-between;
 }
 #hour-select,
 #min-select{
  border: 1px solid #c0c0c0;
  border-radius: 3px;
  line-height: 5;
  padding: .5rem 0;
  width: 48%;
 }
 .btn-wrapper{
    width: 95%;
    margin: 0 auto 1.5rem;
 }


</style>