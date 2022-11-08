<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    //
    use SoftDeletes;

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
