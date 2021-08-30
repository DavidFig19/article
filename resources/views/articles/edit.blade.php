@extends('layout.layout')

@section('contenido')
<div class="container__articles">

<form action="{{url('/articles/'.$article->id)}}" method="POST" enctype="multipart/form-data" class="card shadow">
@csrf
{{method_field('PATCH')}}
@include('articles.form',['modo'=>'Actualizar','btnmode'=>'btn btn-orange btn-block'])
</form>
</div>


@section('script')


<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{asset('/js/article.js')}}"></script>



@stop
@stop
