<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'categories';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['slug', 'link', 'icon', 'is_feat', 'status'];

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
     * Get translate associate with this category
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }

    /**
     * Get vehicles associate with this category
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'category_id', 'id');
    }

    /**
     * Get properties associate with this category
     * @return HasMany
     */
    public function property(): HasMany
    {
        return $this->hasMany(Property::class, 'category_id', 'id');
    }

    /**
     * Get accessories associate with this category
     * @return HasMany
     */
    public function accessory(): HasMany
    {
        return $this->hasMany(Accessory::class, 'category_id', 'id');
    }

    /**
     * Get merchant associate with this category
     * @return BelongsToMany
     */
    public function merchant(): BelongsToMany
    {
        return $this->belongsToMany(Merchant::class, 'category_merchant', 'category_id', 'merchant_id')
            ->withPivot(['started_at', 'expired_at', 'status'])
            ->withCasts(['started_at' => 'datetime', 'expired_at' => 'datetime']);
    }
}
