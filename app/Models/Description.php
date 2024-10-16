<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use League\HTMLToMarkdown\HtmlConverter;

class Description extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'descriptions';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['description_type', 'description_id', 'content', 'local'];

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
     * Interacts with the `content` column
     * @return Attribute
     */
    protected function content(): Attribute
    {
        $markup = new HtmlConverter();
        return Attribute::make(
            get: fn ($value) => $markup->convert(html_entity_decode($value)),
            set: fn ($value) => htmlentities(Str::of($value)->markdown(['html_input' => 'strip'])->toHtmlString())
        );
    }

    /**
     * Get the parent description model
     * @return MorphTo
     */
    public function description(): MorphTo
    {
        return $this->morphTo('description', 'description_type', 'description_id', 'id');
    }

    /**
     * Get vehicles associate with this description
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'description_id', 'id');
    }
}
