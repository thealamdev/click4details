<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detail_feature()
    {
        return $this->hasMany(DetailFeature::class, 'edition_id', 'edition_id');
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class, 'edition_id');
    }

    public function details()
    {
        return $this->belongsTo(Detail::class);
    }
}
