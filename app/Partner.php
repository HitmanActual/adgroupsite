<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $fillable = [

        'title',
        'thumbnail_path',
    ];

    public function getThumbnailPathAttribute($val){

        return ($val !==null)?asset('images/partners/'.$val):"";
    }
}
