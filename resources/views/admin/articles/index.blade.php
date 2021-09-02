@extends('layouts.admin')
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


    <div class="center">
        <a class="btn btn-green" href="{{route('publicaciones.create')}}">
            Nueva publicacion
        </a>
        <br/>
        <br/>
        <br/>
    </div>
   
    @foreach($articles as $article)

    <div class="card-article center shadow" style="margin-bottom: 20px;">
        <section>

            <h3>Titulo: {{$article->name}}</h3>



            <span>Autor: {{$article->author}}</span>


            @if(isset($article->category->name))
            <p>Categoria: {{ $article->category->name }}</p>
            @else
            <p>sin categoria</p>
            @endif
            <hr>




        </section>

        <p class="text-truncate">
            {{$article->description}}
        </p>



        <section>
            <a href="{{ route('publicaciones.edit',$article->id)}}" class="btn btn-orange"><i class="fas fa-edit"></i></a>


            <form action="{{ route('publicaciones.destroy',$article->id)}}" method="POST" style="display: inline-block; ">
                @csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-red" style="min-height:46px;">
                    <i class=" fas fa-trash"></i>
                </button>

            </form>

        </section>

       
    </div>

   

    @endforeach
    
    <div class="center">
    {!! $articles->links() !!}
    </div>
    
    
   
</div>







@endsection