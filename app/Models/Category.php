<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Category extends Model
{
    use HasFactory;


    //relacion uno  a muchos category a article
    public function articles(){

        return $this->hasMany('App\Models\Article');

    }
}
