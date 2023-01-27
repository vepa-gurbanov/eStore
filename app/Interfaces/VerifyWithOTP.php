<?php

namespace App\Interfaces;

use App\Models\User;

interface VerifyWithOTP
{
    public function generateOtp(User $user);

    public function verifyOtp(User $user, $otp);

    public function isVerified();

    public function markAsVerified();

    public function getEmailForVerification();
}
