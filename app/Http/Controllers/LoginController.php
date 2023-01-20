<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    private $response = [
        'estado' => true,
        'mensaje' => null,
        'datos' => null
    ];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        return Inertia::render('Login');
    }

    public function UserLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');
      
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $this->response['mensaje'] = 'Bienvenido ingresando ...';
            $this->response['estado'] = true;
            return response()->json($this->response, 200);
        }
        $this->response['error'] = 'El email o contraseña proporcionados no son válidos.';
        $this->response['estado'] = false;
        return response()->json($this->response, 400);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('login');
    }
}
