@extends('layouts.admin')
@section('titulo')
Categorias
@stop
@section('contenido')
 
<div class="container__categories">

    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGruop" id="openModalGroup">
            <i class="fas fa-plus-circle"></i> Grupo
        </button>
        <br />
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contentParent">


            </tbody>
        </table>
       
    </div>




    <div>
        <button type="button" id="openModalCategory" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategory">
            <i class="fas fa-plus-circle"></i> Categoria
        </button>
        <br />
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contentCategory">


            </tbody>
        </table>
        <div id="pagination-container" ></div>
    </div>
    @section('modal')


    <!-- Modal -->
    <div class="modal fade" id="modalGruop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario grupo</h5>
                    <button type="button" id="closeGroup" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="card_style" id="groupForm">

                        <div class="form-group">
                            <label for="nameCategory">
                                Nombre:
                            </label>
                            <input class="form-input" type="text" name="nameGroup" id="nameGroup" placeholder="Nuevo grupo" autofocus>
                        </div>

                        <small id="error" class="text__danger"></small>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red" data-bs-dismiss="modal" id="cancelGroup"><i class="fas fa-minus-circle"></i> cancelar</button>
                            <button type="submit" class="btn btn-green" id="addNewGroup"><i class="fas fa-save"></i> Guardar</button>

                        </div>
                    </form>



                    <!--form actualizar-->
                    <form class="card_style" id="groupFormUpdate" style="display: none;">
                        <div class="form-group">
                            <label for="">ID:</label>
                            <input type="text" name="idGroupUpdate" id="idGroupUpdate" class="form-input" placeholder="ID" disabled>

                        </div>
                        <div class="form-group">
                            <label for="nameCategory">
                                Nombre:
                            </label>
                            <input class="form-input" type="text" name="nameGroupUpdate" id="nameGroupUpdate" placeholder="Nuevo grupo" autofocus>
                        </div>

                        <small id="errorGroupUpdate" class="text__danger"></small>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red" data-bs-dismiss="modal"><i class="fas fa-minus-circle"></i> cancelar</button>
                            <button type="submit" class="btn btn-orange" id="addNewGroup"><i class="fas fa-undo"></i> Actualizar</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--segundo modal de categorias-->
    <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario categorias</h5>
                    <button type="button" id="closeCategory" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="card_style" id="formCategory">

                        <label for="nameCategory">
                            Nombre:
                        </label>
                        <input class="form-input" type="text" name="nameCategory" id="nameCategory" placeholder="Nueva categoria" autofocus>

                        <span id="errorNameCategory" class="text__danger"></span>
                        <br />
                        <label for="idcategory">Grupo:
                            <select name="parent_category_id" id="parent_category_id" class="form-input">
                                <!--generado con js-->
                            </select>
                        </label>
                        <span id="errorGroupCategory" class="text__danger"></span>
                        <br />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red" data-bs-dismiss="modal" id="cancelCategory"><i class="fas fa-minus-circle"></i> cancelar</button>
                            <button type="submit" class="btn btn-green" id="addNewCategory"><i class="fas fa-save"></i> Guardar</button>

                        </div>
                    </form>


                    <!--Form Actualizar-->
                    <form class="card_style" id="formCategoryUpdate" style="display: none;">
                        <label for="">ID:</label>
                        <input type="text" name="categoryIdUpdate" id="categoryIdUpdate" disabled class="form-input">
                        <label for="nameCategory">
                            Nombre:
                        </label>
                        <input class="form-input" type="text" name="nameCategoryUpdate" id="nameCategoryUpdate" placeholder="Nombre categoria" autofocus>

                        <small id="errorNameCategoryUpdate" class="text__danger"></small>
                        <br />
                        <label for="idcategory">Grupo:
                            <select name="parent_category_id_update" id="parent_category_id_update" class="form-input">
                                <!--generado con js-->
                            </select>
                        </label>
                      
                        <br />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red" data-bs-dismiss="modal"><i class="fas fa-minus-circle"></i> cancelar</button>
                            <button type="submit" class="btn btn-orange" id="addNewCategory"><i class="fas fa-undo" class="paginationjs-theme-blue"></i> Actualizar</button>

                        </div>
                    </form>



                </div>

            </div>
        </div>
    </div>
    @stop

</div>
<link href="{{ asset('css/pagination.css') }}" rel="stylesheet">
@section('script')
<!--jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>

<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{asset('/js/category.js')}}"></script>

@stop
@stop