<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseVehicle extends Model
{
    use HasFactory;

    /**
     * protected guarded properties
     */
    protected $guarded = ['id'];
}
