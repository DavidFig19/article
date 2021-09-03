<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos = ['name' => 'required|string|max:100'];
        $mensaje = ['required' => 'El :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);
        $data = request()->all();

        // $idParent=DB::table('categories')->insertGetId( $data);//trae el id del elemto isertado
        $datos = Category::create($data);
        // $id = $datos->id; //con este puedes scar mas propiedades del objeto
        // $idParent = $datos->parent_category_id;
        // if (!$idParent) {
        //     Category::where('id', '=', $id)->update(['parent_category_id' => $id]); //le asignamos el id padree a la que sera la categoria padre

        // }




        return true;
    }

    public function edit($id)
    {
        return Category::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosCategoria = request()->except('id');

        Category::where('id', '=', $id)->update($datosCategoria);
        return true;
        // $cat = Category::find($id);
        // $cat->name = $request->name;
        // $cat->save();
        // return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Category::destroy($id);
        // return true;

        Category::find($id)->delete();
        return 'OK';
    }


    /*  recuperar grupos de articles que tengan como parent el mismo id */
    public function getAllCat(Request $request)
    {


        $categories = Category::whereNull('parent_category_id')
            ->with('childrenCategory')
            ->get();

        return compact('categories');
    }



    /*Metodo para recuperar solo las categorias del grupo articulos*/
    public function getArticleCategories(Request $request)
    {


        /* aqui se traen los que no son nullos entonces simpre traera a los hijos por que se guardan con categoria */
        $categories = Category::whereNotNull('parent_category_id')
            ->with('childrenCategory')
            ->get();

        return compact('categories');
    }
}
