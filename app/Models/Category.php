<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_category_id'];

    //relacion uno  a muchos category a article
    public function articles()
    {

        return $this->hasMany('App\Models\Article');
    }



    // public function childCategory(){


    //     return $this->hasMany(Category::class,'parent_category_id');
    // }

    // public function parentCategory(){

    //     return $this->belongsTo(Category::class,'parent_category_id');
    // }

    public function categories()
    {
        return $this->hasMany(Category::class,'parent_category_id');
    }

    public function childrenCategory()
    {
        return $this->hasMany(Category::class,'parent_category_id')->with('categories');
    }

    public function parentCategory(){

        return $this->belongsTo(Category::class,'parent_category_id');
    }
}
