<?php

namespace App\Http\Requests\Auth;

use App\Enums\Guard;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mobile'     => ['required', 'string'],
            'password'  => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();
        if (!Auth::guard(Guard::ADMIN->toString())->attempt($this->only('mobile', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages(['mobile' => trans('auth.failed')]);
        }
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        $onError = trans('auth.throttle', ['seconds' => $seconds, 'minutes' => ceil($seconds / 60)]);
        throw ValidationException::withMessages(['mobile' => $onError]);
    }

    /**
     * Get the rate limiting throttle key for the request
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('mobile')) . '|' . $this->ip());
    }
}
