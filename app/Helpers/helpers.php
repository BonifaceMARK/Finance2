<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;
class Helpers
{
    public static function generateOTP()
    {
        $otp = rand(100000, 999999);

        // Store the OTP in the session with a custom expiration time (5 minutes)
        Session::put('otp', $otp);
        Session::put('otp_expires_at', now()->addMinutes(5));

        return $otp;
    }

    public static function isOTPExpired()
    {
        // Check if the session key 'otp_expires_at' exists and is before the current time
        return Session::has('otp_expires_at') && now()->gt(Session::get('otp_expires_at'));
    }
}

