<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featur extends Model
{
    use HasFactory;
    use HasUlids;

    protected $table = 'vhc_features';

    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(Detail::class);
    }
}
