<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Mail\RarakiranaRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    public function register(Request $request)
    {   
        
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect('/login')->with('warning', 'Buka email anda untuk verifikasi akun');
    }

    protected function create(array $data)
    {   
        $slug = str_slug($data['name']);
        $cekslug = User::where('slug', $slug)->first();
        if (count($cekslug) > 0) {
            $slug = $slug.'-'.date("YmdHis");
        }
        $user = User::create([
            'name' => $data['name'],
            'slug' => $slug,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(50),
        ]);
        // mengirim email
        Mail::to($user->email)->send(new RarakiranaRegister($user));
    }

    // verifikasi regiter token user dengan email
    public function verify_register($token, $id){
        $user = User::find($id);
        if (!$user) {
            return redirect('/login')->with('warning', 'siapa anda ?');
        }
        if ($user->token != $token) {
            return redirect('/login')->with('warning', 'apa yang anda lakukan !');
        }
        $user->status = 1;
        $user->save();

        $this->guard()->login($user);
        return redirect('/');
    }

}
