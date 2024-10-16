<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vehicle extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'vhc_products';

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
        return $this->belongsTo(User::class, 'user_id', 'id');
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
     * Get edition associate with this vehicle
     * @return BelongsTo
     */
    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class, 'edition_id', 'id');
    }

    /**
     * Get condition associate with this vehicle
     * @return BelongsTo
     */
    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class, 'condition_id', 'id');
    }

    /**
     * Get transmission associate with this vehicle
     * @return BelongsTo
     */
    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class, 'transmission_id', 'id');
    }

    /**
     * Get engine associate with this vehicle
     * @return BelongsTo
     */
    public function engine(): BelongsTo
    {
        return $this->belongsTo(Engine::class, 'engine_id', 'id');
    }

    /**
     * Get fuel associate with this vehicle
     * @return BelongsTo
     */
    public function fuel(): BelongsTo
    {
        return $this->belongsTo(Fuel::class, 'fuel_id', 'id');
    }

    /**
     * Get skeleton associate with this vehicle
     * @return BelongsTo
     */
    public function skeleton(): BelongsTo
    {
        return $this->belongsTo(Skeleton::class, 'skeleton_id', 'id');
    }

    /**
     * Get mileage associate with this vehicle
     * @return BelongsTo
     */
    public function mileage(): BelongsTo
    {
        return $this->belongsTo(Mileage::class, 'mileage_id', 'id');
    }

    /**
     * Get grade associate with this vehicle
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    /**
     * Get carmodel associate with the vehicle
     * @return BelongsTo
     */
    public function sketch(): BelongsTo
    {
        return $this->belongsTo(Sketch::class, 'sketch_id', 'id');
    }

    /**
     * Get cor associate with the vehicle
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * Get available associate with the vehicle
     * @return BelongsTo
     */
    public function availability(): BelongsTo
    {
        return $this->belongsTo(Availability::class, 'availability_id', 'id');
    }

    /**
     * Get registration associate with the vehicle
     * @return BelongsTo
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
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
     * Get specification associate with this vehicle
     * @return BelongsToMany
     */
    public function specification(): BelongsToMany
    {
        return $this->belongsToMany(Specification::class, 'specification_vehicle', 'vehicle_id', 'specification_id');
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
     * Get vehicle_feature associate with the vehicle
     * @return HasMany
     */
    public function vehicle_feature(): HasMany
    {
        return $this->hasMany(VehicleFeatur::class, 'edition_id', 'edition_id');
    }

    /**
     * Get entity_product associate with the vehicle
     * @return BelongsToMany
     */
    public function entities(): BelongsToMany
    {
        return $this->belongsToMany(related: Entity::class, table: EntityProduct::class, foreignPivotKey: 'product_id', relatedPivotKey: 'entity_id');
    }

    /**
     * Get statement associate with vehicle
     * @return HasOne
     */
    public function statement(): HasOne
    {
        return $this->hasOne(Statement::class, foreignKey: 'product_id', localKey: 'id');
    }

    /**
     * Get price associate with vehicle
     * @return HasOne
     */
    public function price(): HasOne
    {
        return $this->hasOne(related: Price::class, foreignKey: 'product_id', localKey: 'id');
    }
}
