<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Repositories\OtpRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OtpService
{
    protected $otpRepo;

    public function __construct(OtpRepository $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function sendOtp(string $email): bool
    {
        $user = $this->otpRepo->findByEmail($email);

        if (! $user) return false;

        $otp = rand(100000, 999999);
        $this->otpRepo->saveOtp($user, $otp);
        Mail::to($user->email)->send(new OtpMail($otp));

        return true;
    }

    public function verifyOtp(string $email, string $otp): bool
    {
        $user = $this->otpRepo->verifyOtp($email, $otp);

        if (! $user) return false;

        $this->otpRepo->markVerified($user);
        return true;
    }
}