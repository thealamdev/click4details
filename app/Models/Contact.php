<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'contacts';

    /**
     * Set the fillable attributes for the model
     * @var string[]
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
     * The number of models to return for pagination
     * @var int
     */
    protected $perPage = 20;

    /**
     * Interacts with the contact `subject` column
     * @return Attribute
     */
    protected function subject(): Attribute
    {
        return Attribute::make(get: fn ($value) => stripslashes($value), set: fn ($value) => addslashes($value));
    }

    /**
     * Interacts with the contact `message` column
     * @return Attribute
     */
    protected function message(): Attribute
    {
        return Attribute::make(get: fn ($value) => stripslashes($value), set: fn ($value) => addslashes($value));
    }
}
