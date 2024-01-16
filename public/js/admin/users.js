window.addEventListener('load', ()=>{
   let hiddenHeight = 0;
   //隠れているエリア
   let hiddens = document.querySelectorAll('.user-hidden-erea');
   hiddens.forEach(hidden =>{
      hiddenHeight = hidden.clientHeight;
   });
   /*編集ボタン */
  let editButtons = document.querySelectorAll('.edit-btn');
  //ボタン押下

  editButtons.forEach(editbutton =>{
    editbutton.addEventListener('click', event=>{
      let target = editbutton.parentElement.parentElement.children[3];
      let flag = target.dataset.hidden;
      let targetParent = target.parentElement;
      console.log(targetParent);

      if (flag == 0) {
        target.style.opacity = 1;
        target.dataset.hidden = 1;
        target.style.height = 'auto';
      }
      else {
        target.style.opacity = 0;
        target.dataset.hidden = 0;
        target.style.height = 0;
      }
    });
  });
  //input fileの動作
  let file = document.getElementById('csv-file');
  let fileText = document.querySelector('.csv-file-text');
  file.addEventListener('change', event =>{
    let fileContext = event.currentTarget.files[0];
    fileText.textContent = fileContext.name;

  });

/************************************************************************************************ */
});
