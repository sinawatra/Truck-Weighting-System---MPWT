<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightRecord extends Model
{
    protected $fillable = [
        'truck_id',
        'station_id',
        'weight',
        'weight_type'
    ];
    //
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
