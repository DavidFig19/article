<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* Route::prefix('admin')->group(function () {
    Auth::routes(['register'=>false]);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('categorias', CategoryController::class);

    Route::resource('grupo_categoria', CategoryGroupController::class);

    Route::resource('noticias', ArticleController::class);

    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');
}); */

Route::prefix('admin')->group(function () {
    Route::resource('categorias', CategoryController::class);
    Route::resource('publicaciones', ArticleController::class);
});

Route::get('/', [PageController::class, 'index'])->name('site.home');

// Route::get('/noticia/{id}', [PageController::class, 'edit'])->name('site.details');

Route::get('noticia/{id}', [PageController::class, 'details'])->name('site.details');




// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/categorias', [CategoryController::class, 'index'])->name('categorias.index');
// });




/* Route::get('/', function () {
    return view('site.index');
});


Route::get('/categories', function () {
    return view('categories.index');

});
Route::get('/articles', function () {
    return view('articles.index');

});


Route::resource('categories', CategoryController::class);
Route::resource('articles', ArticleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
