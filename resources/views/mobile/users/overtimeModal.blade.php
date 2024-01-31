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
        <form action="{{ route('overtimeModal.update')}}" method="post" class="overtime-modal-contents-form">
          @csrf
          @method('patch')
          
          <!-- フォーム内容 -->
          <dl class="mobile-overtime-modal-contents">
            <!-- 日付け -->
            <dd class="mobile-overtime-modal-items">
               <div class="mobile-overtime-modal-title">日付け</div>
               <div class="mobile-overtime-modal-item"></div>
            </dd>

            <!-- 曜日 -->
            <dd class="mobile-overtime-modal-items">
               <div class="mobile-overtime-modal-title">曜日</div>
               <div class="mobile-overtime-modal-item"></div>
            </dd>

            <!-- 終了予定時間 -->
            <dd class="mobile-overtime-modal-items">
               <div class="mobile-overtime-modal-title">終了予定時間</div>
               <div class="mobile-overtime-modal-item">
                  <div class="mobile-overtime-form-group">
                    <!-- 時間 -->
                    <select name="hour" id="hour-select" class="mobile-overtime-select"></select>

                    <!-- 分 -->
                    <select name="min" id="min-select" class="mobile-overtime-select">
                      <option value="0">0分</option>
                      <option value="15">15分</option>
                      <option value="0">45分</option>
                    </select>
                  </div>
               </div>
            </dd>

            <!-- 明日設定 -->
            <dd class="mobile-overtime-modal-items">
              <div class="mobile-overtime-modal-title">翌日設定</div>
              <div class="mobile-overtime-modal-item">
                 <input type="checkbox" name="tomorrow" id="tomorrow-check">
              </div>
            </dd>

            <!-- 業務処理内容ヘッダー -->
            <dd class="mobile-overtime-modal-items">
              <div class="mobile-overtime-modal-title">業務処理内容</div>
            </dd>

             <!-- 業務処理内容 -->
            <dd class="mobile-overtime-modal-items">
               <div class="mobile-overtime-modal-item process">
                 <input type="text" name="process" id="process-form">
              </div>
            </dd>



            <!-- 上長選択 -->
            <dd class="mobile-overtime-modal-items">
              <div class="mobile-overtime-modal-title">申告上長選択</div>
              <div class="mobile-overtime-modal-item">
                 <select name="superior" id="superior-select" class="mobile-overtime-select"></select>
              </div>
            </dd>



          </dl>

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
    width: 95%;
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
  /**
  **
  モーダルのコンテンツ
  **
  **/
  .overtime-modal-contents{
     width: 100%;
  }
  .overtime-modal-contents-form,
  .mobile-overtime-modal-contents
  {
    width: 100%;
  }
  /**
   各種アイテム
  **/
  .mobile-overtime-modal-items{
    align-items: center;
    border: 1px solid #c0c0c0;
    border-bottom: none;
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin: 0;
  }
  .mobile-overtime-modal-items:last-child{
    border-bottom: 1px solid #c0c0c0;
  }
  .mobile-overtime-modal-title{
   
  }
  .mobile-overtime-modal-item{
    background-color: #FFFFFF;
    border-left: 1px solid #c0c0c0;
    line-height: 4;
    width: 45%;
  }
  .mobile-overtime-select{
    border: 1px solid #d0d0d0;
    display: block;
    padding: .5rem 0;
    width: 95%;
    margin: 1rem auto;
  }
  .process{
    align-items: flex-start !important;
    justify-content: flex-start !important;
    width: 100% !important;
  }
  #process-form{
    border: 1px solid #c0c0c0;
    display: block;
    width: calc(100% - 2px);
    margin: 0 auto;
  }
 
 .btn-wrapper{
    width: 95%;
    margin: 0 auto 1.5rem;
 }


</style>