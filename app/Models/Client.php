<?php

namespace App\Models;

use App\Notifications\EmailVerificationNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * Define the auth guard
     * @var string
     */
    protected string $guard = 'client';

    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'mobile', 'password'];

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
     * Get avatar associate with this client
     * @return MorphOne
     */
    public function avatar(): MorphOne
    {
        return $this->morphOne(Image::class, 'image', 'image_type', 'image_id');
    }

    /**
     * Get address associate with this client
     * @return MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'address', 'address_type', 'address_id');
    }

    /**
     * Get verification associate with this client
     * @return MorphOne
     */
    public function verification(): MorphOne
    {
        return $this->morphOne(Verification::class, 'verification', 'verification_type', 'verification_id');
    }

    /**
     * Get profile associate with this client
     * @return MorphOne
     */
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profile', 'profile_type', 'profile_id');
    }

    public function shippingAddress(){
        return $this->hasOne(shippingAddress::class);
    }
}
