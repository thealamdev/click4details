<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowupMessage extends Model
{
    use HasFactory;

    /**
     * Set the guarded attributes for the model
     * @var string[]
     */
    protected $guarded = ['id'];
}
