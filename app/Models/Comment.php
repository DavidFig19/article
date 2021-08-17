<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    //relacion de uno a muchos entre comments y articles (inverso)
    public function article(){

        return $this->belongsTo('App\Models\Article');
    }

}
