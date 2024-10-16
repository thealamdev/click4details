<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeature extends Model
{
    use HasFactory;

    /**
     * @var protected $guarded
     * protected guarded properties
     */
    protected $guarded = ['id'];
}
