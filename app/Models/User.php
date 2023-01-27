<?php

namespace App\Models;

use App\Interfaces\VerifyWithOTP;
use App\Traits\VerifyOtp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements VerifyWithOTP
{
    use HasFactory, Notifiable, VerifyOtp;

    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];
}
