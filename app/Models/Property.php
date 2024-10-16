<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'properties';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    // protected $fillable = ['slug', 'category_id', 'merchant_id', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'mileage_id', 'grade_id', 'registration', 'manufacture', 'price', 'is_approved', 'publish_at', 'is_feat', 'status', 'color_id','carmodel_id','code'];

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

    public function priceunit(): BelongsTo
    {
        return $this->belongsTo(Priceunit::class, 'priceunit_id', 'id');
    }

    public function sizeunit(): BelongsTo
    {
        return $this->belongsTo(Sizeunit::class, 'sizeunit_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
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
}
