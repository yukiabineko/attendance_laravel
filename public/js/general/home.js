
/**
* ajaxによる残業申請に必要なデータ抽出
*/
const overTimeData = (pushButton, id) => {
   
   let targetUrl = location.protocol + "//" + location.host + "/attendance/public/overtimeModal/" + id;
   let tr = document.getElementById('overtimeModalTr');

   $.ajax({
      url: targetUrl,
      type: 'GET',
      dataType: 'json',
      timeout: 3000,
   }).done(function (data) {
      tr.children[0].textContent = AdjustmentDate( data.attendance.worked_on );
      tr.children[1].textContent = getweek( data.attendance.worked_on );

      //時間セレクト
      let hourSelect = document.getElementById('hour-select');
      const options = hourOption(data.user.finish_time);
      options.forEach(optionvalue =>{
         let option = document.createElement('option');
         option.value = optionvalue;
         option.textContent = optionvalue + "時";
         hourSelect.appendChild(option);
      });

      //上長一覧
      let superiorSelect = document.getElementById('superior-select');
      data.superior.forEach(superior =>{
         let option = document.createElement('option');
         option.value = superior.id;
         option.textContent = superior.name;
         superiorSelect.appendChild(option);
      });
      //従業員id隠し要素
      let attendanceId = document.getElementById('user_id');
      attendanceId.value = data.attendance.user_id;

      //勤怠日隠し要素
      let workedOn = document.getElementById('worked_on');
      workedOn.value = data.attendance.worked_on;


      
      overTimeModalOpen(pushButton);


   }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
      alert("error");
   })
}
/**
 * 残業申請モーダルを出現させる。
 */
const overTimeModalOpen = ( element )=>{
   let targetHeigth = element.getBoundingClientRect().top - element.clientHeight / 2 + window.scrollY;

   let background = document.querySelector('.modal-back');
   background.classList.add('modal-back-show');
   
   let overtimeModal = document.querySelector('.overtime-modal');
   overtimeModal.style.top = targetHeigth + 'px';
   

}
/**
 * 残業申請モーダル閉じる
 */
const overtimeModalClose = ()=>{
   let background = document.querySelector('.modal-back');
   background.classList.remove('modal-back-show');

   //チェックボックスを閉じる
   document.getElementById('tomorrow-check').checked = false;
   //業務内容の入力削除
   document.getElementById('process-form').value = "";



   let overtimeModal = document.querySelector('.overtime-modal');
   overtimeModal.style.top = '-200%';

}
/************************************************************************************************************************** */
/**
 * 日付け
 */
const AdjustmentDate = (baseDate) =>{
   let targetDate = new Date( baseDate );
   const targetMonth = targetDate.getMonth() + 1;
   const targetDay = targetDate.getDate();
   return targetMonth.toString().padStart('2', 0) + "/" + targetDay.toString().padStart('2', 0);

}
/**
 * 曜日
 */
const getweek = ( baseDate )=>{
   let targetDate = new Date(baseDate);
   const weekInt =  Number( targetDate.getDay() );
   const weeks = [ "日", "月", "火", "水", "木", "金", "土" ];
   return weeks[ weekInt ];
}
/**
 * 時間セレクト
 */
const hourOption = ( baseDateTime )=>{
   let firstHour = Number( baseDateTime.split(':')[0]);
   let hourArray = [];
  
   for( let i = firstHour; i<=21; i++ ){
      hourArray.push(i.toString().padStart('0',2));
   }
   console.log(hourArray);
   return hourArray;
}