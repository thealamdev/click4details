<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Accessory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'accessories';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */

    protected $guarded = [
        'id'
    ];
    /**
     * The attributes that should be cast
     * @var array
     */
    protected $casts = [
        'publish_at' => 'datetime',
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
     * Get translate associate with this vehicle
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }

    /**
     * Get merchant associate with this vehicle
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }


    /**
     * Get description associate with this vehicle
     * @return MorphMany
     */
    public function description(): MorphMany
    {
        return $this->morphMany(Description::class, 'description', 'description_type', 'description_id');
    }



    /**
     * Get image associate with this vehicle
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'image', 'image_type', 'image_id');
    }

    /**
     * Get gallery associate with this vehicle
     * @return MorphMany
     */
    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery', 'gallery_type', 'gallery_id');
    }

    public function brand()
    {
        return $this->belongsTo(AccessoryBrand::class, 'accessory_brand_id');
    }
}
