<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'service' => 'required',
            'agence' => 'required',
            'password' => 'required',
        ];
    }


    public function authenticate(): void
    {
        if (!Auth::attempt($this->only('service', 'agence', 'password'))) {
            info('Échec de l\'authentification');
            throw ValidationException::withMessages([
                'service' => trans('auth.failed'),
            ]);
        }
    }
    
}
