<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Helpers;
use App\Mail\mailotp;
class AuthController extends Controller
{
    //
    public function getStr($string, $start, $end) {
        $str = explode($start, $string);
        if (isset($str[1])) {
            $str = explode($end, $str[1]);
            return $str[0];
        }
        return ""; // or handle the case when the pattern is not found
    }

    public function loadRegister()
    {
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('register');
    }

 public function register(Request $request)
{
    $request->validate([
        'name' => 'string|required|min:2',
        'email' => 'string|email|required|max:100|unique:users',
        'password' =>'string|required|confirmed|min:6',
        'username' => 'required|unique:users', // Add validation for username
    ]);

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->username = $request->username; // Assign username
    $user->save();

    return back()->with('success', 'Your Registration has been successful.');
}
    public function loadLogin()
    {
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'string|required|email',
        'password' => 'string|required',
        'username' => 'required', // Add validation for username
    ]);

    $userCredential = $request->only('email', 'password');
    Session::put('ebcf_0_1', $userCredential);
    $ipuser = $request->ip();
    $curl = curl_init();
    $url = "https://api.infoip.io/$ipuser";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $ip = trim(strip_tags($this->getStr($response, '"ip":"', '"')));
    curl_close($curl);

    if (Auth::attempt($userCredential)) {
        $user = Auth::user();
        if ($user->last_ip_loggedin === $ip) {
            return redirect()->route('forecast');
        } else {
            $otp = Helpers::generateOTP();
            $details = [
                'title' => '',
                'body' => "To verify your email address in Finance Guardian, enter the following code: \n \n" . $otp .
                    "\n \nIf you didn't request this email, you can safely ignore it.",
            ];
            Mail::to($request->email)->send(new mailotp($details));
            return redirect()->intended(route('oauth'));
        }
    } else {
        return back()->with('error', 'Username & Password are incorrect');
    }
}


    public function redirectDash()
    {
        $redirect = '';

        if(Auth::user() && Auth::user()->role == 0){
            $redirect = '/user/dashboard';
        }else{
            $redirect = '/user/dashboard';
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
