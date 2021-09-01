@extends('layouts.admin')
@section('titulo')
Crear categoria
@stop
@section('contenido')
<div class="container__articles">

    


    <!--inicia formulario-->
    <form  action="{{ route('publicaciones.index') }}" class="card center shadow" method="POST" enctype="multipart/form-data">

        @csrf


        @include('admin.articles.form',['modo'=>'Guardar','btnmode'=>'btn btn-green btn-block'])


    </form>





</div>

@section('script')


<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{asset('/js/article.js')}}"></script>



@stop


@endsection