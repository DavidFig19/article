document.getElementById("contentCategory").addEventListener("click", (e) => {
    var btnEdit = e.target.parentNode;


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