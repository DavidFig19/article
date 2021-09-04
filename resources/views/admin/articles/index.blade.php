@extends('layouts.admin')
@section('titulo')
Articulos
@stop
@section('contenido')
<nav class="navbar  navbar-light bg-light">
    <div class="container-fluid">
        {!! $articles->links() !!}

        <a class="btn btn-green" href="{{route('publicaciones.create')}}">
            <i class="fas fa-plus-circle"></i> publicacion
        </a>

    </div>
</nav>
<br />
<br />
<div class="container">

    @if(Session::has('message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    </script>
    @endif


    @if(Session::has('error'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    </script>
    @endif


    <div class="row">
        @if(count($articles) > 0)
        @foreach($articles as $article)

        <div class="col-md-6 col-sm-12 col-lg-4">


            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Titulo: {{$article->name}}</h5>
                    <span>Autor: {{$article->author}}</span>

                    @if(isset($article->category->name))
                    <p>Categoria: {{ $article->category->name }}</p>
                    @else
                    <p class="text__danger">sin categoria</p>
                    @endif
                    <hr>
                    <p class="card-text">
                        {{$article->description}}
                    </p>
                    <a href="{{ route('publicaciones.edit',$article->id)}}" class="btn btn-orange"><i class="fas fa-edit"></i></a>


                    <form action="{{ route('publicaciones.destroy',$article->id)}}" method="POST" style="display: inline-block; " class="formulario">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-red" style="min-height:46px;">
                            <i class=" fas fa-trash"></i>
                        </button>

                    </form>
                </div>
            </div>
            <br />



        </div>
        @endforeach

        @else
        <h1 class="text-center">Sin Artículos...</h1>
        @endif


    </div>









</div>







@endsection