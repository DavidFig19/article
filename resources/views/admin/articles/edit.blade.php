@extends('layouts.admin')
@section('titulo')
Editar categoria
@stop
@section('contenido')
<div class="container__articles">

<form action="{{route('publicaciones.update',$article->id)}}" method="POST" enctype="multipart/form-data" class="card center shadow">
@csrf
{{method_field('PATCH')}}
@include('admin.articles.form',['modo'=>'Actualizar','btnmode'=>'btn btn-orange btn-block'])
</form>
</div>
@section('script')


<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{asset('/js/article.js')}}"></script>



@stop
@stop
