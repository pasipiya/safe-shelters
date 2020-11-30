<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\RegisterAdmin;
use App\Mail\RegisterUser;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
     * Where to redirect users after registration.
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
        $validator= Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'reg_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'reg_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->setAttributeNames([
            'reg_email' => 'email',
            'reg_password' => 'password',
        ]);
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $to="admin@gmail.com";
        //$to="piyathilaka111@gmail.com";
        $user_name=$data['name'];
        Mail::to($to)->send(new RegisterAdmin($user_name));
        $to_user_email=$data['reg_email'];
        Mail::to($to_user_email)->send(new RegisterUser());
        return User::create([
            'name' => $data['name'],
            'email' => $data['reg_email'],
            'password' => Hash::make($data['reg_password']),
            'status'=>'0',
            'role'=>'2',
        ]);


    }
}
