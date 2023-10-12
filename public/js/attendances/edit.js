window.addEventListener('load', ()=>{
  //出勤時間のフォームが変更された時
  document.querySelectorAll('.start-form').forEach( start =>{
    //各種出勤フォームを変更された時
    start.addEventListener('input', event=>{
       const id = start.id.split('start-')[1];
       const startTime = start.value;
       const endTime = document.getElementById('end-' + id ).value;
       if( startTime != "" && endTime != ""){
          document.getElementById('total-' + id ).textContent = newTime( startTime, endTime );
       }
    });
    
  });
  /********************************************************** */
   //各種退勤フォームを変更された時
   document.querySelectorAll('.end-form').forEach( end =>{
      end.addEventListener('input', event =>{
        const id = end.id.split('end-')[1];
        const endTime = end.value;
        const startTime = document.getElementById('start-' + id ).value;
        if( startTime != "" && endTime != ""){
          document.getElementById('total-' + id ).textContent = newTime( startTime, endTime );
       }
      });
   });
  /********************************************************** */

});
/****************************************************************** */
/****************************************************************** */
/**
 * 編集ページにて変更された場合の更新数値計算
 */
const newTime = (start, end) =>{
  //出勤時間の時間
  const startData = start.split(':');
  const startHour = startData[0];
  const startMin = startData[1];
  const startTotalMin = Number(startHour)  * 60  + Number( startMin );

  //退勤時間の時間
  const endData = end.split(':');
  const endHour = endData[0];
  const endMin = endData[1];
  const endTotalMin = Number( endHour )  * 60  + Number( endMin );

  if( startTotalMin > endTotalMin ){
     return "";
  }
  else{
    let newTotalHour = Math.floor(parseFloat( (endTotalMin - startTotalMin) / 60 ));
    return newTotalHour;
  }

}