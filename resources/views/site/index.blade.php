@extends('layouts.public')
@section('titulo')
inicio
@stop
@section('contenido')
<div class="row pt-5" id="contentArticle">

</div>



@section('script')
<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  const allArticles = () => {

    let parentCards = document.getElementById('contentArticle');
    let content = "";
    parentCards.innerHTML = "";
    axios.get(`/api/publicaciones`).then((res) => {

      res.data.forEach(item => {
        let categoria = ""
        console.log(item.name)
        //validamos la ctaetoria
        if (item.category) {
          categoria = item.category.name;
        } else {
          categoria = "sin categoria"
        }

        //validamos la imagen
        let imagen = "";
        if (item.image) {

          imagen = `storage/${item.image}`
        } else {

          imagen = "https://img.freepik.com/vector-gratis/concepto-fondo-noticias-falsas_23-2148514224.jpg?size=626&ext=jpg"
        }
        content += `
     
   
    <div class="col-sm-6 col-lg-4 col-xl-3 mb-2">
      <div class="card">
      <img src="${imagen}" class="card-img-top" alt="imagen noticia" >
        <div class="card-body">
          <h5 class="card-title text-danger">${item.name}</h5>
          <p>${categoria}</p>
          <p class="card-text">
          ${item.description}
          </p>
          
        </div>
        <a href="{{ url('/noticia/${item.id}')}}" class="btn btn-secondary btn-block btn-edit">VER MAS...</a>
      </div>
    </div>


      

        `;
      })
      parentCards.innerHTML = content;

    })

  }

  allArticles();

  const getOneCat = (param) => {

    let parentCards = document.getElementById('contentArticle');
    let content = "";
    parentCards.innerHTML = "";
    axios.get(`/api/publicaciones/${param}`).then((res) => {

      res.data.forEach(item => {
        console.log(item.name)
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
      })
      parentCards.innerHTML = content;

    })
  }
</script>
@stop
@endsection