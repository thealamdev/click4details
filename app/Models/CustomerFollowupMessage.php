<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerFollowupMessage extends Model
{
    use HasFactory;

    /**
     * @var protected 
     * guarded properties.
     */

    protected $guarded = ['id'];

    /**
     * relation with user model.
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * relation with customer model.
     */

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /**
     * relation with CustomerFollowupMessage & customerFollowupMessageFeedback Model.
     */
    public function customerFollowupMessageFeedback(): HasMany
    {
        return $this->hasMany(CustomerFollowupMessageFeedback::class, 'customer_followup_message_id', 'id');
    }
}
