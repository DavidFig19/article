@extends('layout.layout')
@section('titulo')
Articulos
@stop
@section('contenido')
<div class="container__articles">

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


    <div class="card center">
        <a class="btn btn-green" href="{{url('articles/create')}}">
            Nueva publicacion
        </a>
    </div>
    <br />
    @foreach($articles as $article)

    <div class="card-article center shadow" style="margin-bottom: 20px;">
        <section>

            <h3>Titulo: {{$article->name}}</h3>



            <span>Autor: {{$article->author}}</span>


            <h5>Categoria: {{ $article->category->name }}</h5>
            <hr>

        </section>

        <p class="text-truncate">
            {{$article->description}}

        </p>



        <section>
            <a href="{{url ('/articles/'.$article->id.'/edit')}}" class="btn btn-orange"><i class="fas fa-edit"></i></a>


            <form action="{{ url('/articles/'.$article->id)}}" method="POST" style="display: inline-block; ">
                @csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-red" style="min-height:46px;">
                    <i class=" fas fa-trash"></i>
                </button>

            </form>

        </section>


    </div>

    @endforeach


</div>







@endsection