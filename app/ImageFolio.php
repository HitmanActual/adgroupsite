<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageFolio extends Model
{
    //

    use SoftDeletes;
    protected $fillable = [
        'folio_id',
        'image_path',
    ];


    public function folios(){
        return $this->belongsTo(Folio::class);
    }
    
      public function getImagePathAttribute($val){

        return ($val !==null)?asset('images/folios/'.$val):"";
    }


}
