<?php

namespace App\Models;

use App\Services\Utils\FileResourceManipulate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;
    use FileResourceManipulate;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'images';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['image_type', 'image_id', 'disk', 'name', 'path', 'mime', 'size'];

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
     * Get the parent image model
     * @return MorphTo
     */
    public function image(): MorphTo
    {
        return $this->morphTo('image', 'image_type', 'image_id', 'id');
    }
}
