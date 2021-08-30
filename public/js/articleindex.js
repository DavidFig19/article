

const getAllData = () => {
    axios.get("api/articulos").then((res) => {
        let contenedor = document.getElementById("containerCat");
        let contenido = "";
        contenedor.innerHTML='';

        res.data.forEach(item=>{

            contenido+=`
            <div class="card shadow">

                <h4>${item.name}</h4>
                <span>${item.author}</span>
                <p>
                ${item.description}
                </p>
    
            </div>
            <br/>
            <br/>
            <br/>
            `;

        });

        contenedor.innerHTML=contenido;
    });
};
getAllData();
