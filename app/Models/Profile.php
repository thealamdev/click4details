<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Profile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'profiles';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['profile_type', 'profile_id', 'ip_address', 'first_name', 'last_name', 'gender', 'birth_date', 'status'];

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
     * Get the parent profile model
     * @return MorphTo
     */
    public function profile(): MorphTo
    {
        return $this->morphTo('profile', 'profile_type', 'profile_id', 'id');
    }
}
