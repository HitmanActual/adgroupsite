<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageService extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'service_id',
        'image_path',
    ];


    public function service(){
        return $this->belongsTo(Service::class);
    }
    
    
    
      public function getImagePathAttribute($val){

        return ($val !==null)?asset('images/services/'.$val):"";
    }


}
