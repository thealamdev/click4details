<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityProduct extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * Define public property $table
     * @var string
     */
    protected $table = 'vhc_entity_product';
}
