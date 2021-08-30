const inputFIle = document.getElementById('imgFile');
const imgPreview = document.getElementById('preview');
// Escuchar cuando cambie
// if (inputFIle.value == "") {
//     imgPreview.src = "https://cdn.pixabay.com/photo/2016/03/21/20/05/image-1271454_640.png"
// }
inputFIle.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = inputFIle.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        imgPreview.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imgPreview.src = objectURL;
});


const getAllcategories = () => {
    let dropDown=document.getElementById('idCategory');
    let content='';
    dropDown.innerHTML='';
    axios.get("/api/categorias")
        .then((response) => {
            // console.log(response.data);
           
            response.data.forEach(item=>{
                content+=`
                    <option value="${item.id}" name="category_id" id="${item.id}">
                    ${item.name}
                    </option>
                `;
            });
           dropDown.innerHTML=content;
        });
}

getAllcategories();

