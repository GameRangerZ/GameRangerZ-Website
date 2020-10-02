<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mailbox;
use App\Providers\RouteServiceProvider;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SinusBot\API;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            recaptchaFieldName() => recaptchaRuleName(),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        //@Todo Create Queued Job
        Mailbox::create([
            'domain_id' => 1,
            'email' => $data['username'] . "@gamerangerz.de",
            'password' => crypt($data['password'], sprintf('$6$%s$', substr(bin2hex(openssl_random_pseudo_bytes(16)), 0, 16))),
            'user_id' => $user->id
        ]);
        //@Todo Create Queued Job
        $sinusbot = new API(env("MUSICBOT_URI"));
        $sinusbot->login(env('MUSICBOT_USERNAME'), env('MUSICBOT_PASSWORD'));
        $sinusbot->addUser($user->username, $data['password'], 61445);

        return $user;
    }
}
