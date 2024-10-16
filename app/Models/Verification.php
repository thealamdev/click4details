<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Verification extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'verifications';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['verification_type', 'verification_id', 'channel', 'secret', 'expired_at', 'status'];

    /**
     * The attributes that should be cast
     * @var array
     */
    protected $casts = [
        'expired_at' => 'datetime',
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
     * Get the parent verification model
     * @return MorphTo
     */
    public function verification(): MorphTo
    {
        return $this->morphTo('verification', 'verification_type', 'verification_id', 'id');
    }
}
