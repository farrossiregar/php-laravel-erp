<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Login extends Component
{
    public $email;
    public $password;
    public $message, $token;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.login')
                ->layout('layouts.auth');
    }

    public function login()
    {
        $this->validate();
        
        if(is_numeric($this->email)){
            $field = 'nik';
        } elseif (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }else{
            $field = 'email';
        }

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret='.env('CAPTCHA_SITE_SECRET').'&response='. $this->token);
        $response = $response->json();
        
        if (!$response['success']) {
            $this->message = 'Google thinks you are a bot, please refresh and try again';
        }else{
        
            $credentials = [$field=>$this->email,'password'=>$this->password];

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect('/');
            }
            else $this->message = __('Email / Password incorrect please try again');
        }
    }
}
