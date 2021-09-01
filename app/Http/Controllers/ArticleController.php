<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['articles'] = Article::paginate(5);
        return view('admin.articles.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'author' => 'required|string',
            'image' => 'required'
        ];

        $mensaje = [
            'name.required' => 'el Titulo es requerido',
            'description.required' => 'La Descripción es requerida',
            'author.required' => 'el Autor es requerido',
            'image.required' => 'La Foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        //$dataArticles=request()->all();
        $dataArticles = request()->except('_token');
        if ($request->hasFile('image')) {
            $dataArticles['image'] = $request->file('image')->store('uploads', 'public');
        }

        Article::create($dataArticles);

        //return response()->json($dataArticles);
        return redirect()->route('publicaciones.index')->with('message', 'Articulo añadido');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $campos = [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'author' => 'required|string',
            
        ];

        $mensaje = [
            'name.required' => 'el Titulo es requerido',
            'description.required' => 'La Descripción es requerida',
            'author.required' => 'el Autor es requerido',
            'image.required' => 'La Foto es requerida'
        ];
        if ($request->hasFile('image')) {
            $campos = ['image' => 'required|max:100|mimes:jpeg,png,jpg',];
            $mensaje = ['image.required' => 'La Foto es requerida',];
        }
        $this->validate($request, $campos, $mensaje);



        //
        $data= request()->except(['_token', '_method']);

        if ($request->hasFile('image')) {
            $article = Article::findOrFail($id);
            Storage::delete('public/' . $article->image);
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }


        Article::where('id', '=', $id)->update($data);

        $article = Article::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect()->route('publicaciones.index')->with('message', 'Articulo modificado :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $article = Article::findOrFail($id);

        if (Storage::delete('public/' . $article->image)) {

            Article::destroy($id);
        }





        return redirect()->route('publicaciones.index')->with('error', 'Articulo eliminado');;
    }
}
