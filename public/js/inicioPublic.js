function simpleTemplating(data) {
    var html = "";
    $.each(data, function (index, i) {
        html += `
        <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
      <div class="card">
      <img src="${i.image}" class="card-img-top" alt="imagen noticia" >
        <div class="card-body">
          <h5 class="card-title text-danger">${i.name}</h5>
          <p>${i.category}</p>
          <p class="card-text">
          ${i.description}
          </p>
          
        </div>
        <a href="#" class="btn btn-secondary btn-block btn-edit">Go somewhere</a>
      </div>
    </div>


        `;
    });

    return html;
}

const allArticles = () => {
    let arr_empty = [];

    axios.get(`/api/publicaciones`).then((res) => {
        res.data.forEach((item) => {
            let categoria = "";

            //validamos la cateria
            if (item.category) {
                categoria = item.category.name;
            } else {
                categoria = "sin categoria";
            }

            //validamos la imagen
            let imagen = "";
            if (item.image) {
                imagen = `storage/${item.image}`;
            } else {
                imagen =
                    "https://img.freepik.com/vector-gratis/concepto-fondo-noticias-falsas_23-2148514224.jpg?size=626&ext=jpg";
            }
            //llenamos un el array vacion con los datos validados
            arr_empty.push({
                name: item.name,
                image: imagen,
                category: categoria,
                description: item.description,
            });
        });
        console.log(arr_empty);
        //hacemos uso de paginator
        $("#pagination-container").pagination({
            dataSource: arr_empty,
            pageSize: 8,
            // showPageNumbers: false,
            // showNavigator: true,
            showPrevious: false,
            showNext: false,
            className: "paginationjs-theme-blue",

            callback: function (data, pagination) {
                // $("#contentCategory").html(content);+
                var html = simpleTemplating(data);
                $("#contentArticle").html(html);
            },
        });
    });
};

allArticles();

const getOneCat = (param) => {
    let parentCards = document.getElementById("contentArticle");
    let content = "";
    parentCards.innerHTML = "";
    axios.get(`/api/publicaciones/${param}`).then((res) => {
        res.data.forEach((item) => {
            console.log(item.name);
            content += `

    <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
      <div class="card">
      <img src="storage/${item.image}" class="card-img-top" alt="imagen noticia" >
        <div class="card-body">
          <h5 class="card-title text-danger">${item.name}</h5>
          <p>${item.category.name}</p>
          <p class="card-text">
          ${item.description}
          </p>
          
        </div>
        <a href="#" class="btn btn-secondary btn-block btn-edit">Go somewhere</a>
      </div>
    </div>



`;
        });
        parentCards.innerHTML = content;
    });
};
