<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'company_name',
        'message',
        'demo_date',
        'service_id',
    ];
    
    
    public function services(){
        return $this->belongsTo(Service::class);
    }


}
