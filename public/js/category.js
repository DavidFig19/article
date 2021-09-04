//limpiar modal add group al hacer click

document.getElementById("openModalGroup").addEventListener("click", () => {
    let inputName = document.getElementById("nameGroup");
    inputName.value = "";
    let form = document.getElementById("groupForm");
    let form2 = document.getElementById("groupFormUpdate");
    form.style.display = "block";
    form2.style.display = "none";

    
   
});

document.getElementById('openModalCategory').addEventListener('click',()=>{
    let inputName=document.getElementById('nameCategory');
    inputName.value="";
    let formCatagory = document.getElementById("formCategory");
    let formCategoryUpdate = document.getElementById("formCategoryUpdate");
    formCatagory.style.display = "block";
    formCategoryUpdate.style.display = "none";

});



//validar al cerrar modales
document.getElementById('cancelGroup').addEventListener('click',()=>{
     document.getElementById("error").innerText="";
     document.getElementById('nameGroup').value="";
    

})
document.getElementById('closeGroup').addEventListener('click',()=>{
    document.getElementById("error").innerText="";
    document.getElementById('nameGroup').value="";
})



document.getElementById('closeCategory').addEventListener('click',()=>{
    document.getElementById("errorNameCategory").innerText="";
    document.getElementById('nameCategory').value="";
})


document.getElementById('cancelCategory').addEventListener('click',()=>{
    document.getElementById("errorNameCategory").innerText="";
    document.getElementById('nameCategory').value="";
})









//Datos de los grupos/categorias padre
const getAllDataGroup = () => {
    axios.get("/api/categorias").then((res) => {
        console.log(res.data);
        let table = document.getElementById("contentParent");
        let dropDown = document.getElementById("parent_category_id");
        //para el drop de actualizar
        let dropDownUpdate=document.getElementById('parent_category_id_update');
        dropDownUpdate.innerHTML="";
        dropDown.innerHTML = "";
        table.innerHTML = "";
        let content = "";
        let contentDrop = "";
        for (elemento in res.data) {
            // console.log(`${elemento}: ${res.data[elemento]}`);
            res.data[elemento].forEach((item) => {
                content += `
                <tr>
    
                    <td>${item.name}</td>
                    <td>
                        <div class="btn-group">
                        <button value="${item.id}"  id="deleteRow" type="button" class="btn btn-red"><i class="fas fa-trash"></i></button>
                        <button value="${item.id}" id="editRow"  type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modalGruop"><i class="fas fa-edit"></i></button>
                        </div>
                    </td>
                </tr>
            `;
            });
        }

        table.innerHTML = content;

        for (elemento in res.data) {
            res.data[elemento].forEach((item) => {
                contentDrop += `
                <option value="${item.id}">${item.name}</option>

            `;
            });
        }

        dropDown.innerHTML = contentDrop;
        dropDownUpdate.innerHTML=contentDrop;
       
    });
};

getAllDataGroup();

//Datos de las categorias hijas
const getAllDataCategory = () => {
    axios.get("/api/categorias").then((res) => {
        console.log(res.data);
        let table = document.getElementById("contentCategory");

        table.innerHTML = "";
        let content = "";
        let grupo = "";
        for (elemento in res.data) {
            res.data[elemento].forEach((item) => {
                //aparte de hacerle foreach al elemto objeto cada uno
                //tiene otro objeto hijo adentro
                //se mapea ese para acceder a las propiedades del hijo y solo
                //asignamos el nombre del padre
                item.children_category.forEach((i) => {
                    content += `
                    <tr>
        
                        <td>${i.name}</td>
                        <td>
                        <span class="badge bg-info text-dark">
                        ${item.name}
                        </span>
                        
                        </td>
                        <td>
                            <div class="btn-group">
                            <button value="${i.id}" id="deleteCat" type="button" class="btn btn-red"><i class="fas fa-trash"></i></button>
                            <button value="${i.id}" id="editCat"  type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#modalCategory"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
                });
            });
        }

        table.innerHTML = content;
    });
};

getAllDataCategory();

// Add new group
document.getElementById("groupForm").addEventListener("submit", (e) => {
    let nombreGrupo = document.getElementById("nameGroup");
    let errorValidar = document.getElementById("error");

    e.preventDefault();

    if (nombreGrupo.value === "") {
        errorValidar.innerText = "*campo requerido*";
    } else {
        axios({
            method: "post",
            url: "/api/categorias",
            data: {
                name: nombreGrupo.value,
            },
        })
            .then(function (response) {
                console.log(response);
                nombreGrupo.value = "";
                alertify.success("Grupo agregado");
                errorValidar.innerText = "";
                getAllDataGroup();
                getAllDataCategory();
                errorValidar.innerText = "";
                document.getElementById("closeGroup").click(); //presionar el botn de cerrado si se cumpleta el response
            })
            .catch(function (err) {
                console.log(err);
                // if (err.response.data.errors) {
                //     // alertify.error(err.response.data.errors.name[0])
                //     errorValidar.innerText = 'No puede estar vacio';
                // }
            });
    }
});

//Add new category

document.getElementById("formCategory").addEventListener("submit", (e) => {
    let nombreCategoria = document.getElementById("nameCategory");
    let grupoCategoria = document.getElementById("parent_category_id");
    let errorValidarName = document.getElementById("errorNameCategory");
    let errorValidarGroup = document.getElementById("errorGroupCategory");

    e.preventDefault();
    console.log(nombreCategoria.value);

    if (nombreCategoria.value === "") {
        errorValidarName.innerText = "*campo requerido*";
    } else {
        axios({
            method: "post",
            url: "/api/categorias",
            data: {
                name: nombreCategoria.value,
                parent_category_id: grupoCategoria.value,
            },
        })
            .then(function (response) {
                console.log(response);
                nombreCategoria.value = "";
                errorValidarGroup.value = "";
                alertify.success("Categoria Agregada");
                errorValidarName.innerText = "";
                getAllDataGroup();
                getAllDataCategory();
                errorValidarName.innerText = "";
                document.getElementById("closeCategory").click(); //presionar el botn de cerrado si se cumpleta el response
            })
            .catch(function (err) {
                console.log(err);
                // if (err.response.data.errors) {
                //     // alertify.error(err.response.data.errors.name[0])
                //     errorValidar.innerText = 'No puede estar vacio';
                // }
            });
    }
});

//eliminar padre

document.getElementById("contentParent").addEventListener("click", (e) => {
    let btnDelete = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnDelete.value);
    if (btnClick.value === undefined) {
        btnClick = e.target.parentNode;
    }
    console.log(btnClick.value);

    if (btnDelete.id === "deleteRow") {
        alertify.confirm(
            "¡Alerta!",
            "Esta  apunto de eliminar un grupo",
            function () {
                axios.delete(`/api/categorias/${btnClick.value}`).then(() => {
                    getAllDataCategory();
                    getAllDataGroup();
                    alertify.success("Grupo eliminado");
                });
            },
            function () {
                alertify.error("Acción cancelada");
            }
        );
    }
    //en caso de no detecar el click realiza

    if (btnClick.id === "deleteRow") {
        alertify.confirm(
            "¡Alerta!",
            "Esta  apunto de eliminar un grupo",
            function () {
                axios.delete(`/api/categorias/${btnClick.value}`).then(() => {
                    getAllDataCategory();
                    getAllDataGroup();
                    alertify.success("Grupo eliminado");
                });
            },
            function () {
                alertify.error("Acción cancelada");
            }
        );
    }
});

//eliminar categorias o childrens
document.getElementById("contentCategory").addEventListener("click", (e) => {
    let btnDelete = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnDelete.value);
    if (btnClick.value === undefined) {
        btnClick = e.target.parentNode;
    }
    console.log(btnClick.value);

    if (btnDelete.id === "deleteCat") {
        alertify.confirm(
            "¡Alerta!",
            "Esta  apunto de eliminar un grupo",
            function () {
                axios.delete(`/api/categorias/${btnClick.value}`).then(() => {
                    getAllDataCategory();
                    getAllDataGroup();
                    alertify.success("Categoria eliminada");
                });
            },
            function () {
                alertify.error("Acción cancelada");
            }
        );
    }
    //en caso de no detecar el click realiza

    if (btnClick.id === "deleteCat") {
        alertify.confirm(
            "¡Alerta!",
            "Esta  apunto de eliminar un grupo",
            function () {
                axios.delete(`/api/categorias/${btnClick.value}`).then(() => {
                    getAllDataCategory();
                    getAllDataGroup();
                    alertify.success("Categoria eliminada");
                });
            },
            function () {
                alertify.error("Acción cancelada");
            }
        );
    }
});

//Editar grupo o categoria padre

document.getElementById("contentParent").addEventListener("click", (e) => {
  
    let form = document.getElementById("groupForm");
    let form2 = document.getElementById("groupFormUpdate");
    form.style.display = "none";
    form2.style.display = "block";
    let btnEdit = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnEdit);
    if (btnClick.value === undefined) {
        btnClick = e.target.parentNode;
    }

    // console.log(btnClick)
    if (btnEdit.id === "editRow") {
        axios
            .get(`/api/categorias/${btnEdit.value}/edit`)
            .then(function (response) {
                // handle success
                console.log(response);
                
                let inputId = document.getElementById("idGroupUpdate");
                let inputName = document.getElementById("nameGroupUpdate");

                inputId.value = response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }

    if (btnClick.id === "editRow") {
        axios
            .get(`/api/categorias/${btnClick.value}/edit`)
            .then(function (response) {
                // handle success
                console.log(response);
               
                let inputId = document.getElementById("idGroupUpdate");
                let inputName = document.getElementById("nameGroupUpdate");
                inputId.value = response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }
});

//update del padre o grupo
document.getElementById("groupFormUpdate").addEventListener("submit", (e) => {
    e.preventDefault();
    let idGroup=document.getElementById('idGroupUpdate');
    let nameGroup = document.getElementById("nameGroupUpdate");
    let validadador=document.getElementById('errorGroupUpdate');
    if(nameGroup.value===""){
        validadador.innerText="*Camporequerido*";
    }else{
        axios({
            method: "put",
            url: `/api/categorias/${idGroup.value}`,
            data: {
                
                name: nameGroup.value,
            },
        }).then(function (res) {
            getAllDataGroup();
            getAllDataCategory();
            //cerramos modal;
            validadador.innerText="";
            alertify.success("Grupo Actualizado");
            document.getElementById("closeGroup").click(); //presionar el botn de cerrado si se cumpleta el response
    
            // console.log(res);
        });
    }
    
});







//editar categoria o hijo

document.getElementById("contentCategory").addEventListener("click", (e) => {
  
    let form = document.getElementById("formCategory");
    let form2 = document.getElementById("formCategoryUpdate");
    form.style.display = "none";
    form2.style.display = "block";
    let btnEdit = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnEdit);
    if (btnClick.value === undefined) {
        btnClick = e.target.parentNode;
    }

    // console.log(btnClick)
    if (btnEdit.id === "editCat") {
        axios
            .get(`/api/categorias/${btnEdit.value}/edit`)
            .then(function (response) {
                // handle success
                console.log(response);
                
                let inputCategoryId=document.getElementById('categoryId');
                let inputName = document.getElementById("nameCategoryUpdate");

                inputCategoryId.value=response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }

    if (btnClick.id === "editCat") {
        axios
            .get(`/api/categorias/${btnClick.value}/edit`)
            .then(function (response) {
                // handle success
                console.log(response);
                let inputCategoryId=document.getElementById('categoryIdUpdate');
                let inputName = document.getElementById("nameCategoryUpdate");

                inputCategoryId.value=response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }
});


//update del hijo o categoria
document.getElementById("formCategoryUpdate").addEventListener("submit", (e) => {
    e.preventDefault();
    let idGroup=document.getElementById('parent_category_id_update');
    let idCat=document.getElementById('categoryIdUpdate');
    let nameCat = document.getElementById("nameCategoryUpdate");
    let validador=document.getElementById('errorNameCategoryUpdate');
    if(nameCat.value===""){
        validador.innerText="*Camporequerido*"
    }else{
        axios({
            method: "put",
            url: `/api/categorias/${idCat.value}`,
            data: {
                
                name: nameCat.value,
                parent_category_id:idGroup.value,
            },
        }).then(function (res) {
            getAllDataGroup();
            getAllDataCategory();
            //cerramos modal;
            validador.innerText=""
            alertify.success("Categoria Actualizada :)");
            document.getElementById("closeCategory").click(); //presionar el botn de cerrado si se cumpleta el response
    
            // console.log(res);
        });
    }
    
});