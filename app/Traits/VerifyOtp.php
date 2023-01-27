<?php

namespace App\Traits;

use App\Models\User;
use App\Notifications\VerifyOtpNotification;
use Illuminate\Support\Str;

trait VerifyOtp
{
    public function generateOtp(User $user): string
    {
        $otp = rand(10000, 99999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();
        return $otp;

    }

    public function verifyOtp(User $user, $otp): bool
    {
        if ($user->otp_code === $otp && $user->otp_expires_at > now()) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            return true;
        }
        return false;
    }

    public function isVerified(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function markAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendOtpEmailVerificationNotification(User $user): void
    {
        $otp = $this->generateOtp($user);
        $this->notify(new VerifyOtpNotification($user, $otp));
    }

    public function getEmailForVerification()
    {
        return $this->email;
    }
}
