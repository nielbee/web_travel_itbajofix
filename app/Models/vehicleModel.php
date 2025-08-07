<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicleModel extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'plate_number'; // Assuming plate_number is the primary key
    protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'pict1',
        'pict2',
        'pict3',
        'price',
        'availability'
    ];

    protected $casts = [
        'plate_number' => 'string',
    ];
}
