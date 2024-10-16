<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleFeatur extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function feature()
    {
        return $this->belongsTo(Featur::class,'featur_id');
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }
}
