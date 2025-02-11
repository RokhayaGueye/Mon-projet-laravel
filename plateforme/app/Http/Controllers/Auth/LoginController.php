<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Services\TelegramService;

class LoginController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        }

        $otp = rand(100000, 999999);

        
        Session::put('otp', $otp);
        Session::put('user_id', $user->id);
        Session::put('telegram_chat_id', $user->telegram_chat_id);

       
        $this->telegramService->sendMessage($user->telegram_chat_id, 'Bonjour ' . $user->name . ', votre OTP est : ' . $otp);

        
        return redirect()->route('otp.form');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}