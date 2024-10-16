<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCare extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * Define the auth guard
     * @var string
     */
    protected string $guard = 'customercare';

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'customer_cares';

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast
     * @var string[]
     */
    protected $casts = [
        'email_verified_at'     => 'datetime',
        'mobile_verified_at'    => 'datetime',
    ];

    /**
     * Send email verification notification
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification('admin.verification.verify'));
    }

    /**
     * Send a password reset notification to the user
     * @param       $token
     * @return void
     * @noinspection PhpUndefinedFieldInspection
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification(sprintf('%s/admin/reset-password/%s?email=%s', config('app.url'), $token, $this->email)));
    }

    /**
     * Get avatar associate with this merchant
     * @return MorphOne
     */
    public function avatar(): MorphOne
    {
        return $this->morphOne(Image::class, 'image', 'image_type', 'image_id');
    }

    /**
     * Get address associate with this merchant
     * @return MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'address', 'address_type', 'address_id');
    }

    /**
     * Get verification associate with this merchant
     * @return MorphOne
     */
    public function verification(): MorphOne
    {
        return $this->morphOne(Verification::class, 'verification', 'verification_type', 'verification_id');
    }

    /**
     * Get profile associate with this merchant
     * @return MorphOne
     */
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profile', 'profile_type', 'profile_id');
    }

    /**
     * Get category associate with this merchant
     * @return BelongsToMany
     */
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_merchant', 'merchant_id', 'category_id');
    }

    /**
     * Get vehicle associate with this merchant
     * @return HasMany
     */
    public function vehicle(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'merchant_id', 'id');
    }

    public function code()
    {
        return $this->hasMany(Code::class,);
    }

    public function merchantInfo()
    {
        return $this->hasOne(MerchantInfo::class);
    }

    /**
     * morphs relations.
     */
    public function owner(): MorphTo
    {
        return $this->morphTo('owner', 'parent_type', 'parent_id', 'id');
    }
}
