<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
        Category::create($data);
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
         $datosCategoria=request()->except('id');
       
        Category::where('id','=',$id)->update($datosCategoria);
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
        Category::destroy($id);
        return true;
    }

    public function getAllCat(){
        $category = Category::all();
        return $category;
    }
}
