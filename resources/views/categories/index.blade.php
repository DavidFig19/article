@extends('layout.layout')

@section('contenido')
<div class="container__categories" style="align-self: center;">
    <div>

        <form class="card shadow" id="categoryForm">
            <span>Formulario Categoria</span>


            <label for="nameCategory">
                Nombre:
            </label>
            <input  class="form-input" type="text" name="nameCategory" id="nameCategory" placeholder="Nueva categoria" autofocus>

            <label id="error" class="text__danger"></label>
                <br>
            <button type="submit" class="btn btn-green btn-block" id="addNewCategory">Añadir categoria</button>

        </form>
    </div>




    <table class="table shadow" style="align-self: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="contentCategory">


        </tbody>
    </table>
    @section('modal')
    <!--modal-->
    <div class="fondo_transparente">
        <div class="modal">
            <div class="modal_cerrar">
                <span>x</span>
            </div>
            <div class="modal_titulo">VENTANA MODAL</div>
            <form id="updateCategory" class="modal_mensaje">
                <input type="text" name="IDCategory" id="IDCategory" placeholder="ID usuario" disabled>
                <input type="text" name="nameEdit" id="nameEdit" placeholder="ID usuario">
                <button class="btn btn-green" type="submit">ACEPTAR</button>
            </form>

        </div>
    </div>
    @stop

</div>



@section('script')
<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{asset('/js/category.js')}}"></script>

@stop
@stop