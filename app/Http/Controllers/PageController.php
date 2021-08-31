<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class PageController extends Controller
{
    //
    public function index()
    {
        //
        
       //
    //    $datos['articles'] = Article::paginate(5);
      
    //    return view('publicFront.index',$datos);
        return view('publicFront.index');
        
    }
}
