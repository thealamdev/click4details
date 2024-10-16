<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'addresses';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['address_type', 'address_id', 'street_no_1', 'street_no_2', 'apartment_or_unit', 'zip_code', 'city', 'state', 'country', 'latitude', 'longitude', 'status'];

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
     * Interacts with the `location` column
     * @return Attribute
     */
    protected function location(): Attribute
    {
        return Attribute::make(get: fn ($value) => stripslashes($value), set: fn ($value) => addslashes($value));
    }

    /**
     * Get the parent address model
     * @return MorphTo
     */
    public function address(): MorphTo
    {
        return $this->morphTo('address', 'address_type', 'address_id', 'id');
    }
}
