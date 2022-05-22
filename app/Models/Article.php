<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable=['name','description','author','image','category_id'];
   
    //relacion uno a muchos inversa articles y usuarios (inverso)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    //relacion uno a muchos de article a comentarios

    public function comments(){
        return $this->hasMany('App\models\Commment');
    }


    //relacion uno a muchos de article a categorias(inverso)
    public function category(){

        return $this->belongsTo('App\Models\Category');
    }


}
