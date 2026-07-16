<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //
    protected $fillable = [
        'station_code',
        'name',
        'location',
        'latitude',
        'longitude',
        'machine_code',
        'status',
        'description'
    ];

    //one station can has many record 
    public function weightRecords()
    {
        return $this->hasMany(WeightRecord::class);
    }
}
