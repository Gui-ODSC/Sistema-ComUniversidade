<?php

namespace App\Http\Controllers\MembroController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMembroController extends Controller
{
    public function visualizar()
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

            return redirect()->route('minhas_demandas_membro');
        }

        return back()->withErrors([
            "message" => 'Email ou Senha Inválidos.',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login_index');
    }

}
