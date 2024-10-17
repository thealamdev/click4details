<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * Define public property $table
     * @var string
     */
    protected $table = 'vhc_entities';

    public function feature()
    {
        return $this->hasOne(Featur::class,'id','feature_id');
    }
}
