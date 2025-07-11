<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Session;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        if ($this->otpService->sendOtp($request->email)) {
            Session::flash('flash_message','OTP sent!');
            return redirect()->back()->with('status_color','success');
        }

        Session::flash('flash_message','User not found.');
        return redirect()->back()->with('status_color','warning');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string'
        ]);

        // $dd = $this->otpService->verifyOtp($request->email, $request->otp);
        // dd($dd);

        if ($this->otpService->verifyOtp($request->email, $request->otp)) {
            Session::flash('flash_message','Account Fully verified!');
            return redirect()->back()->with('status_color','success');
        }

        Session::flash('flash_message','Invalid or expired OTP.');
        return redirect()->back()->with('status_color','success');
    }
}