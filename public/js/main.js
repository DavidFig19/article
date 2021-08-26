document.getElementById("contentCategory").addEventListener("click", (e) => {
    let btnEdit = e.target.parentNode;

    let btnClick = e.target;
   
    if(btnClick.value === undefined){
      btnClick = e.target.parentNode;
      
    }
    if (btnClick.id === "editRow") {
        document.getElementsByClassName
        ("fondo_transparente")[0].style.display='block'
        return false;
        
    }
    if (btnEdit.id === "editRow") {
        document.getElementsByClassName
        ("fondo_transparente")[0].style.display='block'
        return false;
        
    }
});



document.getElementsByClassName('modal_cerrar')[0].
addEventListener(
    'click',
    ()=>{
        document.getElementsByClassName("fondo_transparente")[0].style.display='none'
    }

)