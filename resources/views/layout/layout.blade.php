<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--bootstwatch-->
    <!-- <link rel="stylesheet" href="https://bootswatch.com/5/materia/bootstrap.min.css"> -->
    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!--font awesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- CSS Alertify-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />


</head>

<body>

    <header class="container__header">
        <span>Diario local</span>
        <div>
            <button><i class="fas fa-sign-out-alt"></i></button>
        </div>
    </header>

    <aside class="sideBar shadow">
        <ul class="sideBar__menu">
           
            <img src="https://www.w3schools.com/w3images/avatar2.png" alt="logo admin" class="sideBar__menu-logo">
            
          
            <li>
                <a href="#"><i class="fad fa-ballot-check"></i> Categorias</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-comments"></i> Comentarios</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-newspaper"></i> Publicaciones</a>
            </li>
        </ul>

    </aside>
        
    <!--Aqui va el contenido-->
    <main class="container">
        

       
        @yield('contenido')

        
        

    </main>

    @yield('modal')
    <!-- <script data-main="{{asset('/js/main.js')}}" src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script> -->

    <!--Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


    @yield('script')

    <!--My Js-->
    <script src="{{asset('/js/main.js')}}"></script>
    <!-- JavaScript Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



</body>

</html>