<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Translate extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'translates';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['translate_type', 'translate_id', 'title', 'local'];

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
     * Interacts with the `title` column
     * @return Attribute
     */
    protected function title(): Attribute
    {
        return Attribute::make(get: fn ($value) => stripslashes($value), set: fn ($value) => addslashes($value));
    }

    /**
     * Get the parent translate model
     * @return MorphTo
     */
    public function translate(): MorphTo
    {
        return $this->morphTo('translate', 'translate_type', 'translate_id', 'id');
    }
}
