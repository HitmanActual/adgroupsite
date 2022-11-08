<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    //

    use SoftDeletes;
    protected $table = 'services';

    protected $fillable = [
        'company_id',
        'title',
        'thumbnail_path',
        'description',
        'video_url',

    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function getThumbnailPathAttribute($val){

        return ($val !==null)?asset('images/services/'.$val):"";
    }

    public function imageServices(){
        return $this->hasMany(ImageService::class);
    }


    public function demos(){
        return $this->hasMany(Demo::class);
    }


}
