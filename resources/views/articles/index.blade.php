@extends('layout.layout')

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


    <div class="card">
        <a class="btn btn-green" href="{{url('articles/create')}}">
            Nueva publicacion
        </a>
    </div>
    <br />
    @foreach($articles as $article)
    <div class="card shadow" style="margin-bottom: 20px;">
        <label >
        Titulo:
        </label>
        <h4>{{$article->name}}</h4>
        <label>
            Autor:
        </label>
        <span>{{$article->author}}</span>
        <p>
            {{$article->description}}
        </p>

       
      <div style="width:100%; display:flex; ">
      <a href="{{url ('/articles/'.$article->id.'/edit')}}" class="btn btn-orange"><i class="fas fa-edit"></i></a>
        
        
        <form action="{{ url('/articles/'.$article->id)}}" method="POST">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-red""><i class="fas fa-trash"></i></button>
        </form>
       
      </div>
      
    </div>

    @endforeach


</div>







@endsection