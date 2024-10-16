<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSkeleton extends Model
{
    use HasFactory;
     /**
     * protected guarded properties.
     */

     protected $guarded = ['id'];
}
