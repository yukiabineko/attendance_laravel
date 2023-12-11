window.addEventListener('load', ()=>{

  let workTimes = document.querySelectorAll('.work_times');
  const now = new Date();
  const hour = now.getHours();
  const min = now.getMinutes();
  const nowMin = Number(hour) * 60 + min;


  workTimes.forEach(( workTime )=>{
    /**
     * 実労働時間
     */
     workTime.style.color = "red";
     const startedAt = workTime.parentElement.children[3];
     console.log(startedAt);
     const startTime = Number(timeSet(startedAt.textContent ));
     //実労働時間の計算
     let wt = parseFloat(((nowMin - startTime) / 60).toFixed(1));
     workTime.textContent = wt;
     /**
      * 残りの労働時間(契約終了時間から計算)
      */
    const finishedAt = workTime.parentElement.children[2];
    const finishTime = Number(timeSet(finishedAt.textContent));
    //残り時間の計算
    let ft = parseFloat(((finishTime - nowMin) / 60).toFixed(1));
    workTime.parentElement.children[5].textContent = ft;
    /**
     * 契約上の残り終了時間の計算
     */

     setInterval(() => {
       wt = parseFloat( (wt +=0.25).toFixed(1));
       workTime.textContent = wt

       ft = parseFloat( ( ft -= 0.25).toFixed(1));
       workTime.parentElement.children[5].textContent = ft;

     }, 900000);


  });
  

});
/********************************************************** */
/**
 * 時間の計算
 */
const timeSet = ( baseTime )=>{
  const hour = baseTime.split(':')[0];
  const min = baseTime.split(':')[1];
  return Number( hour ) * 60 +  Number( min );
}