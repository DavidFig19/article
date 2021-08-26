@extends('layout.layout')

@section('contenido')


<div class="container__articles">

<!--inicia formulario-->
<form class="card shadow"  >


<input type="text" class="form-input" placeholder="ID del articulo" id="idArticle" name="idArticle" disabled>
<label for="">Titulo:</label>
<input type="text" class="form-input" placeholder="Titulo del articulo" id="nameArticle" name="nameArticle">
<label for="">Autor:</label>
<input type="text" class="form-input" placeholder="Autor del articulo" id="authorArticle" name="nameArticle">
<label for="">Descripción:</label>
<textarea name="" id="" cols="30" rows="10" class="form-input"></textarea>

<button class="btn btn-green" type="submit" id="saveArticle">
<i class="fas fa-save"></i>
Guardar
</button>
<button class="btn" type="submit" id="deleteArticle" disabled="true">
<i class="fas fa-trash"></i>
Eliminar
</button>
<button class="btn" type="submit" id="updateArticle" disabled="true">
<i class="fas fa-undo"></i>
Actualizar
</button>
</form>





</div>

@endsection