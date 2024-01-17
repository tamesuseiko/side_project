<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mouse',
        'id_keyboard',
        'details',
        'id_user',
        'status',

    ];
}
