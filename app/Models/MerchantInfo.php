<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantInfo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'image', 'image_type', 'image_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
