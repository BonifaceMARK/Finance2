<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\mailotp;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class OTPController extends Controller
{
    public function getStr($string, $start, $end) {
        $str = explode($start, $string);
        if (isset($str[1])) {
            $str = explode($end, $str[1]);
            return $str[0];
        }
        return "OTP not found"; // Custom message indicating OTP was not found
    }


    public function showOTPForm()
    {
        return view('otpform');
    }

    public function validateOTP(Request $request)
    {
        //=======================
    $ipuser =$request->ip();
    $curl = curl_init();
    $url = "https://api.infoip.io/$ipuser";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $ip = trim(strip_tags($this->getStr($response, '"ip":"', '"')));
    curl_close($curl);
    // ==================
        $request->validate([
            'entered_otp' => 'required|numeric|digits:6',
        ]);
        $storedCredentials = Session::get('ebcf_0_1');
        $enteredOTP = $request->input('entered_otp');
        $storedOTP = session('otp');

        if ($enteredOTP == $storedOTP) {
            session()->forget('otp');
            if (Auth::attempt($storedCredentials)) {
                $user = Auth::user();
                $user->last_ip_loggedin = $ip;
                $user->save();

                return redirect()->route('oauth.succeed');
            } else {
                return redirect()->route('loadlogin')->with('errors', 'Invalid credentials.');
            }
        } else {
            return redirect()->back()->with('errors', 'Invalid OTP. Please try again.');
        }
    }

    public function success(Request $request)
    {
//=======================
    $ipuser =$request->ip();
    $curl = curl_init();
    $url = "https://api.infoip.io/$ipuser";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $ip = trim(strip_tags($this->getStr($response,'"ip":"','"')));
    $city = trim(strip_tags($this->getStr($response,'"city":"','"')));
    $country = trim(strip_tags($this->getStr($response,'"country_long":"','"')));
    curl_close($curl);
    $user = auth()->user();
    $detailx = [
            'title' =>"Hi $user->name,\n",
            'body' => "We noticed an unusual login from a device or location you don't usually use. Was this you?\n \n" .
            "$ip \n$city, $country",
        ];
        Mail::to($user->email)->send(new mailotp($detailx));
        return redirect(route('forecast'));
    }
}
