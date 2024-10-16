<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FurnishedStatus extends Model
{
    use HasFactory;

    /**
     * protected guarded propereties
     */
    protected $guarded = ['id'];

    /**
     * Get translate associate with this vehicle
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }
}
