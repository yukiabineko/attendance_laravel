window.addEventListener('load', ()=>{
  //出勤時間のフォームが変更された時
  document.querySelectorAll('.start-form').forEach( start =>{
    //各種出勤フォームを変更された時
    start.addEventListener('input', event=>{
       const id = start.id.split('start-')[1];
       alert(id);
    });
  });
  //

});