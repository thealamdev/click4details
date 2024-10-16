<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentCar extends Model
{
    use HasFactory;

    /**
     * Define protected property $guarded
     */
    protected $guarded = ['id'];

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

    /**
     * Get description associate with this vehicle
     * @return MorphMany
     */
    public function description(): MorphMany
    {
        return $this->morphMany(Description::class, 'description', 'description_type', 'description_id');
    }

    /**
     * Get brand associate with this vehicle
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * Get carmodel associlate with the RentCar
     * @return BelongsTo
     */
    public function carmodel(): BelongsTo
    {
        return $this->belongsTo(Carmodel::class, 'carmodel_id', 'id');
    }

    /**
     * Get cor associate with the vehicle
     * @return BelognsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * Get translate associate with this vehicle
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }
}
