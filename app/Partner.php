<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [

        'title',
        'thumbnail_path',
    ];

    public function getThumbnailPathAttribute($val){

        return ($val !==null)?asset('images/partners/'.$val):"";
    }
}
