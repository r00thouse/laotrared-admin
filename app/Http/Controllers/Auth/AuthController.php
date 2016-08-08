<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/panel/nodos';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin()
    {
        return view('login.login');
    }

    protected function getRegister()
    {
        return view('login.signup');
    }

    public function postRegister(Request $r)
    {
        if ($this->validator()->fails()) {
            return redirect('/signup')
                ->with('error', 'Datos incorrectos');
        }

        $user = new User();
        $user->fill($r->only(['name', 'email']));
        $user->password = bcrypt($r->get('password'));
        $user->save();
        $user->attachRole(parent::getRole('common'));

        return redirect('/')
            ->with('message', 'Registro completado exitosamente');
    }

}
