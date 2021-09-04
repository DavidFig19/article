//limpiar modal add group al hacer click

document.getElementById("openModalGroup").addEventListener("click", () => {
    let inputName = document.getElementById("nameGroup");
    inputName.value = "";
    let form = document.getElementById("groupForm");
    let form2 = document.getElementById("groupFormUpdate");
    form.style.display = "block";
    form2.style.display = "none";
   
});

//Datos de los grupos/categorias padre
const getAllDataGroup = () => {
    axios.get("/api/categorias").then((res) => {
        console.log(res.data);
        let table = document.getElementById("contentParent");
        let dropDown = document.getElementById("parent_category_id");
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
    });
};

getAllDataGroup();

//Datos de los articulos
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
                            <button value="${i.id}" id="editCat"  type="button" class="btn btn-orange"><i class="fas fa-edit"></i></button>
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

document.getElementById("groupCategory").addEventListener("submit", (e) => {
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

//update
document.getElementById("groupFormUpdate").addEventListener("submit", (e) => {
    e.preventDefault();
    let idCat=document.getElementById('idGroupUpdate');
    let nameCat = document.getElementById("nameGroupUpdate");
    if(nameCat.value===""){
        document.getElementById('errorGroupUpdate').innerText="*Camporequerido"
    }else{
        axios({
            method: "put",
            url: `/api/categorias/${idCat.value}`,
            data: {
                
                name: nameCat.value,
            },
        }).then(function (res) {
            getAllDataGroup();
            getAllDataCategory();
            //cerramos modal;
    
            alertify.success("Grupo Actualizado");
            document.getElementById("closeGroup").click(); //presionar el botn de cerrado si se cumpleta el response
    
            // console.log(res);
        });
    }
    
});
