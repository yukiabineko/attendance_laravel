/**
* ajaxによる残業申請に必要なデータ抽出
*/
const overTimeDataMobile = (pushButton, id) => {

   let targetUrl = location.protocol + "//" + location.host + "/attendance/public/overtimeModal/" + id;
   let tr = document.getElementById('overtimeModalTr');

   $.ajax({
      url: targetUrl,
      type: 'GET',
      dataType: 'json',
      timeout: 3000,
   }).done(function (data) {
     //各項目
     let items = document.querySelectorAll('.mobile-overtime-modal-item');
     //日付
     items[0].textContent = AdjustmentDate(data.attendance.worked_on);
     //曜日
     items[1].textContent = getweek(data.attendance.worked_on);
     //時間セレクト
      let hourSelect = document.getElementById('hour-select');
      const options = hourOption(data.user.finish_time);
      options.forEach(optionvalue => {
         let option = document.createElement('option');
         option.value = optionvalue;
         option.textContent = optionvalue + "時";
         hourSelect.appendChild(option);
      });
      //上長一覧
      let superiorSelect = document.getElementById('superior-select');
      data.superior.forEach(superior => {
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