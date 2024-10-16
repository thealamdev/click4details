<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowupMessageService extends Model
{
    use HasFactory;

    /**
     * Set the guarded attributes for the model
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * relation with FollowupMessage class.
     */

    public function message()
    {
        return $this->belongsTo(FollowupMessage::class, 'followup_message_id', 'id');
    }
}
