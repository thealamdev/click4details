<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Color extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'vhc_colors';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['title', 'status'];

    /**
     * The attributes that should be cast
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The storage format of the model's date columns
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The number of models to return for pagination
     * @var int
     */
    protected $perPage = 20;

    /**
     * Get translate associate with this edition
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }

    /**
     * Get vehicle associate with this edition
     * @return HasMany
     */
    public function vehicle(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'color_id', 'id');
    }
}
