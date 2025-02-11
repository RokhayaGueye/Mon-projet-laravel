<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    
    private $otpList = [
        '123456', '654321', '111111', '222222', '333333',
        '444444', '555555', '666666', '777777', '888888'
    ];

    
    public function showOtpForm()
    {
        return view('auth.otp_verify');  
    }

    public function verifyOtp(Request $request)
    {
        
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        
        $otp = (string) trim($request->otp);

      
        if (in_array($otp, $this->otpList)) {

            return redirect()->route('home')->with('success', 'Authentification réussie !');
        } else {
          
            return back()->withErrors(['otp' => 'OTP invalide. Veuillez réessayer.']);
        }
    }
}
