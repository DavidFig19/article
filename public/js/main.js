const getFecha = () => {
    const hoy = new Date();
    const fecha = `${hoy.getDate()}-${hoy.getMonth() + 1}-${hoy.getFullYear()}`;
    const hora = `${hoy.getHours()}:${hoy.getMinutes()}`;

    let fechaLocal=document.getElementById('fechaLocal');
    // fechaLocal.innerText = `Mérida,Yucatán a ${fecha} ${hora}  horas`;
    fechaLocal.innerHTML=`Mérida,Yucatán a ${fecha} <i class="fas fa-calendar"></i> ${hora}  <i class="fas fa-clock"></i>`;
    setTimeout(getFecha, 1000)
};

getFecha();
setTimeout(getFecha, 1000)





document.getElementById("contentCategory").addEventListener("click", (e) => {
    let btnEdit = e.target.parentNode;

    let btnClick = e.target;

    if (btnClick.value === undefined) {
        btnClick = e.target.parentNode;
    }
    if (btnClick.id === "editRow") {
        document.getElementsByClassName("fondo_transparente")[0].style.display =
            "block";
        return false;
    }
    if (btnEdit.id === "editRow") {
        document.getElementsByClassName("fondo_transparente")[0].style.display =
            "block";
        return false;
    }
});

document
    .getElementsByClassName("modal_cerrar")[0]
    .addEventListener("click", () => {
        document.getElementsByClassName("fondo_transparente")[0].style.display =
            "none";
    });
