<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * Set the guarded attributes for the model.
     */
    protected $guarded = ['id'];

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
     * relation with Customer & User Model.
     */

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * relation with Customer & BrandCustomer Model.
     */
    public function brandCustomer(): HasMany
    {
        return $this->hasMany(BrandCustomer::class, 'customer_id');
    }

    /**
     * relation with Customer & ConditionCustomer Model.
     */

    public function conditionCustomer(): HasMany
    {
        return $this->hasMany(ConditionCustomer::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerEdition Model.
     */

    public function customerEdition(): HasMany
    {
        return $this->hasMany(CustomerEdition::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerMileage Model.
     */

    public function customerMileage(): HasMany
    {
        return $this->hasMany(CustomerMileage::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerEngine Model.
     */

    public function customerEngine(): HasMany
    {
        return $this->hasMany(CustomerEngine::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerFuel Model.
     */

    public function customerFuel(): HasMany
    {
        return $this->hasMany(CustomerFuel::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerSkeleton Model.
     */

    public function customerSkeleton(): HasMany
    {
        return $this->hasMany(CustomerSkeleton::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerTransmission Model.
     */

    public function customerTransmission(): HasMany
    {
        return $this->hasMany(CustomerTransmission::class, 'customer_id');
    }

    /**
     * relation with Customer & CarmodelCustomer Model.
     */

    public function carmodelCustomer(): HasMany
    {
        return $this->hasMany(CarmodelCustomer::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerManufacture Model.
     */

    public function customerManufacture(): HasMany
    {
        return $this->hasMany(CustomerManufacture::class, 'customer_id');
    }

    /**
     * relation with Customer & ColorCustomer Model.
     */

    public function colorCustomer(): HasMany
    {
        return $this->hasMany(ColorCustomer::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerGrade Model.
     */

    public function customerGrade(): HasMany
    {
        return $this->hasMany(CustomerGrade::class, 'customer_id');
    }

    /**
     * relation with Customer & AvailableCustomer Model.
     */

    public function availableCustomer(): HasMany
    {
        return $this->hasMany(AvailableCustomer::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerRegistration Model.
     */

    public function customerRegistration(): HasMany
    {
        return $this->hasMany(CustomerRegistration::class, 'customer_id');
    }

    /**
     * relation with Customer & CustomerFeature Model.
     */

    public function customerFeature(): HasMany
    {
        return $this->hasMany(CustomerFeature::class, 'customer_id','id');
    }

    /**
     * relation with Cutomer & customerFollowupMessage Model.
     */

    public function customerFollowupMessage(): HasMany
    {
        return $this->HasMany(CustomerFollowupMessage::class, 'customer_id', 'id');
    }
}
