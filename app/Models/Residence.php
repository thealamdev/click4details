<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Residence extends Model
{
    use HasFactory;

    /**
     * Define protected property $guarded
     */
    protected $guarded = ['id'];

    /**
     * Get completionStatus associate with this residence
     * @return BelongsTo
     */
    public function completionStatus(): BelongsTo
    {
        return $this->belongsTo(CompletionStatus::class, 'completion_status_id', 'id');
    }

    /**
     * Get furnishedStatus associate with this residence
     * @return BelongsTo
     */
    public function furnishedStatus(): BelongsTo
    {
        return $this->belongsTo(FurnishedStatus::class, 'furnished_status_id', 'id');
    }

    /**
     * Get apartmentComplex associate with this residence
     * @return BelongsTo
     */
    public function apartmentComplex(): BelongsTo
    {
        return $this->belongsTo(ApartmentComplex::class, 'apartment_complex_id', 'id');
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

    /**
     * Get description associate with this vehicle
     * @return MorphMany
     */
    public function description(): MorphMany
    {
        return $this->morphMany(Description::class, 'description', 'description_type', 'description_id');
    }

    /**
     * Get translate associate with this residence
     * @return MorphMany
     */
    public function translate(): MorphMany
    {
        return $this->morphMany(Translate::class, 'translate', 'translate_type', 'translate_id');
    }
}
