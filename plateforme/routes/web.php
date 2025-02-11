<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\TelegramController;

// Routes pour l'inscription
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes pour la connexion

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Route pour la déconnexion
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes pour la vérification de l'OTP

Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp-verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Route pour tester l'envoi de message Telegram
Route::get('/send-telegram-message', [TelegramController::class, 'sendMessageTest'])->name('telegram.test');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::middleware(['auth'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
