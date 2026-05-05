<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   protected $fillable = [
    'app_name',
    'email',
    'phone',
    'address',
    'description',
    'currency',
    'wave_number',
    'orange_number'
];
}
