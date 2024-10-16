<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'orders';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $guarded = [ 
        'id'
    ];

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
    protected $perPage = 10;

    public function card_order(){
        return $this->hasMany(CardOrder::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    
}
