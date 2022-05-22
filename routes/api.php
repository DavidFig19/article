<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ArticleController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categorias', CategoryController::class);
Route::resource('publicaciones', ArticleController::class);

Route::get('categorias',[CategoryController::class, 'getAllCat'])->name('categorias.getAllCat');

Route::get('publicaciones',[ArticleController::class, 'getAllArt'])->name('articulos.getAllArt');
Route::get('publicaciones/{category}',[ArticleController::class,'getOneTypeArticle'])->name('articulos.getOneTypeArticle');


/*  ruta para recuperar solo las categorias hijas de articulo o publicacion */
Route::get('category/articles',[CategoryController::class,'getArticleCategories'])->name('articulos.getArticleCategory');