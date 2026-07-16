<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    //fillable oy ke dak insert ban
    protected $fillable = [
        'company_id',
        'plate_number',
        'driver_name',
        'car_model',
        'weight',
    ];
   
    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }
}
