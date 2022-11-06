<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    //
    protected $table = 'companies';
    protected $fillable = [
        'title',
    ];

    public function services(){
        return $this->hasMany(Service::class);
    }


    public function folios(){
        return $this->hasMany(Folio::class);
    }


}
