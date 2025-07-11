<?php 

namespace App\Repositories;

use App\Models\User;

class OtpRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function saveOtp(User $user, string $otp): void
    {
        $user->update([
            'otp_code' => $otp
        ]);
    }

    public function verifyOtp(string $email, string $otp): ?User
    {
        return User::where('email', $email)
            ->where('otp_code', $otp)
            ->first();
    }

    public function markVerified(User $user): void
    {
        $user->update([
            'email_verified_at' => now(),
            'otp_code' => null
        ]);
    }
}