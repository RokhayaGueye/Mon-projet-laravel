<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Fonction de validation
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Validation du reCAPTCHA
        if (empty($data['g-recaptcha-response']) || !$this->verifyCaptcha($data['g-recaptcha-response'])) {
            $validator->errors()->add('recaptcha', 'Veuillez valider le CAPTCHA.');
        }

        return $validator;
    }

    // Fonction pour vérifier la validité du reCAPTCHA
    protected function verifyCaptcha($captchaResponse)
    {
        $secretKey = env('NOCAPTCHA_SECRET'); // Utilisation de la clé secrète depuis le fichier .env
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $captchaResponse,
        ]);

        return $response->json()['success']; // Doit renvoyer true si le CAPTCHA est validé
    }

    // Fonction pour créer un nouvel utilisateur
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
