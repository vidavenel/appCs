<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\RegisteredUser;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_token' => str_replace('/', '', bcrypt(str_random(15)))
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->notify(new RegisteredUser());

        return redirect('login')->with('success', 'Votre compte a bien été créer, un email de vous sera envoyé pour le confirmer');
    }

    public function confirm($id, $token) {
        $user = User::where('id', $id)->where('confirmation_token', $token)->first();
        if ($user){
            $user->update(['confirmation_token' => null]);
            return view('auth.confirm');
        }
        else {
            return redirect('/login')->with('error', 'Lien de confirmation invalide');
        }
    }
}
