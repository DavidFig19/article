<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class PageController extends Controller
{
    //
    public function index()
    {
  
        return view('site.index');

    }

    public function details($id)
    {

        $article = Article::findOrFail($id);
        return view('site.edit', compact('article'));
    }


}
