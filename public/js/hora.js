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