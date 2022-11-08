<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folio extends Model
{
    //
use SoftDeletes;
    protected $table = 'folios';

    protected $fillable = [
        'company_id',
        'title',
        'thumbnail_path',
        'description',
        'video_url',
        'client',
        'web_url',

    ];



    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function getThumbnailPathAttribute($val){

        return ($val !==null)?asset('images/folios/'.$val):"";
    }

    public function imageFolios(){
        return $this->hasMany(ImageFolio::class);
    }
}
