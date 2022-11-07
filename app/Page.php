<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    protected $fillable = [
        'section',
        'title',
        'subtitle',
        'video_url',
        'thumbnail_path',
        'description',
    ];


    public function getThumbnailPathAttribute($val){

        return ($val !==null)?asset('images/pages/'.$val):"";
    }
}
