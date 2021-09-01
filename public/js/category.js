const getAllData = () => {
    
    axios
        .get('/api/categorias')
        .then((res) => {
            let table = document.getElementById('contentCategory');
            table.innerHTML = "";
            let content = '';
            console.log(res.data);
            res.data.forEach(item => {
                content += `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>
                        <div class="btn-group">
                        <button value="${item.id}" id="deleteRow" type="button" class="btn btn-red"><i class="fas fa-trash"></i></button>
                        <button value="${item.id}" id="editRow"  type="button" class="btn btn-orange"><i class="fas fa-edit"></i></button>
                        </div>
                    </td>
                </tr>
            `;
            })

            table.innerHTML = content;
        });
}

getAllData();

// para agregar un nuevo elemento
document.getElementById("categoryForm").addEventListener("submit", (e) => {
    let nombreCategoria = document.getElementById("nameCategory");
    let errorValidar = document.getElementById('error');

   
    e.preventDefault();
   if(nombreCategoria.value===''){
    errorValidar.innerText = '*campo requerido*';
   }else{
    axios({
        method: 'post',
        url: '/api/categorias',
        data: {
            name: nombreCategoria.value
        }
    })

    .then(function(response) {


        console.log(response);
        nombreCategoria.value = "";
        alertify.success('Categoria agregada')
        errorValidar.innerText = '';
        getAllData();
    })
    .catch(function(err) {

        console.log(err)
        // if (err.response.data.errors) {
        //     // alertify.error(err.response.data.errors.name[0])
        //     errorValidar.innerText = 'No puede estar vacio';
        // }

    });
   }
});


//Delete
document.getElementById("contentCategory").addEventListener("click", (e) => {
    let btnDelete = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnDelete.value)
    if(btnClick.value === undefined){
      btnClick = e.target.parentNode;
      
      
    }
    console.log(btnClick.value)
   
    if (btnDelete.id === "deleteRow") {
      
       
        alertify.confirm('¡Alerta!', 'Esta  apunto de eliminar una categoria', function() {

            axios.delete(`api/categorias/${btnDelete.value}`).then(() => {
                getAllData();
                alertify.success('Categoria Eliminada satisfactoriamente');
            });


        }, function() {
            alertify.error('Acción cancelada')
        });



    }


    //en caso de no detecar el click realiza

    if (btnClick.id === "deleteRow") {
      
       
        alertify.confirm('¡Alerta!', 'Esta  apunto de eliminar una categoria', function() {

            axios.delete(`/api/categorias/${btnClick.value}`).then(() => {
                getAllData();
                alertify.success('Categoria Eliminada satisfactoriamente');
            });


        }, function() {
            alertify.error('Acción cancelada')
        });



    }




});

//Edit

document.getElementById("contentCategory").addEventListener("click", (e) => {
    let btnEdit = e.target.parentNode;
    let btnClick = e.target;
    console.log(btnEdit)
    if(btnClick.value === undefined){
      btnClick = e.target.parentNode;
      
    }
    // console.log(btnClick)
    if (btnEdit.id === "editRow") {

        axios.get(`/api/categorias/${btnEdit.value}/edit`)
            .then(function(response) {
                // handle success
                console.log(response);
                let inputId = document.getElementById('IDCategory');
                let inputName = document.getElementById('nameEdit');
                inputId.value = response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            })
            .then(function() {
                // always executed
            });




    }
    

    if (btnClick.id === "editRow") {

        axios.get(`/api/categorias/${btnClick.value}/edit`)
            .then(function(response) {
                // handle success
                console.log(response);
                let inputId = document.getElementById('IDCategory');
                let inputName = document.getElementById('nameEdit');
                inputId.value = response.data.id;
                inputName.value = response.data.name;
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            })
            .then(function() {
                // always executed
            });




    }
});



//update
document.getElementById('updateCategory').addEventListener('submit', (e) => {
    e.preventDefault();
    let idCat =document.getElementById('IDCategory'); 
    let nameCat=document.getElementById("nameEdit");
     
    axios({
            method: 'put',
            url: `/api/categorias/${idCat.value}`,
            data: {
                id:idCat.value,
                name: nameCat.value
            }
        })

        .then(function(res) {
            getAllData();
           //cerramos modal;
           document.getElementsByClassName("fondo_transparente")[0].style.display='none';
           alertify.success('Categoria Actualizada');

            // console.log(res);

           
        })
   
})