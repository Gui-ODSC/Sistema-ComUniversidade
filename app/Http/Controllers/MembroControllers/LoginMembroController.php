<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMembroController extends Controller
{
    public function index()
    {
        return view('autenticacaoUsuario/login_membro');   
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Campo Obrigatório',
            'password.required' => 'Campo Obrigatório',
        ]); 

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            
            $request->session()->regenerate();

            return redirect()->route('demanda_index');
        }

        return back()->withErrors([
            "message" => 'Email ou Senha Inválidos.',
        ]);

    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->to(route('login_index'))->with(Auth::logout());
    }

}
