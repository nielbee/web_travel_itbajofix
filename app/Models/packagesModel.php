<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class packagesModel extends Model
{
    protected $table = 'travel_packages';

    protected $fillable = [
        
        'title',
        'description',
        'photo1',
        'photo2',
        'photo3',
        'price',
        'default_message'
    ];
}
