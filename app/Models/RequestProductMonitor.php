<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProductMonitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_reques_product',
        'id_monitor',
    ];
}
