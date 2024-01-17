window.addEventListener('load', ()=>{
   let hiddenHeight = 0;
   //隠れているエリア
   let hiddens = document.querySelectorAll('.user-hidden-erea');
   hiddens.forEach(hidden =>{
     hidden.style.opacity = 1;
      hiddenHeight = hidden.children[0].clientHeight;
      
   });
   /*編集ボタン */
  let editButtons = document.querySelectorAll('.edit-btn');
  //ボタン押下

  editButtons.forEach(editbutton =>{
    editbutton.addEventListener('click', event=>{
      let target = editbutton.parentElement.parentElement.children[3];
      let flag = target.dataset.hidden;
      let targetParent = target.parentElement;
     


      if (flag == 0) {
        target.dataset.hidden = 1;
        target.style.height = hiddenHeight + 'px';
        target.style.opacity = 1;
      }
      else {
        target.dataset.hidden = 0;
        target.style.height = 0;
        target.style.opacity = 0;
        
      }
    });
  });
  //input fileの動作
  let file = document.getElementById('csv-file');
  let fileText = document.querySelector('.csv-file-text');
  file.addEventListener('change', event =>{
    fileText.textContent = "";
    let fileContext = event.currentTarget.files[0];
    fileText.textContent = fileContext.name;

  });

/************************************************************************************************ */
});
