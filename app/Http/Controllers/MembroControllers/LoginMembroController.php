<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
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
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Campo Obrigatório',
            'email.email' => 'Formato de email inválido',
            'password.required' => 'Campo Obrigatório',
        ]); 
    
        // Verifica se o usuário com o email fornecido é do tipo "professor"
        $user = Usuario::where('email', $request->email)->first();
    
        if ($user && $user->tipo === 'MEMBRO') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('demanda_index');
            } else {
                return back()->withErrors([
                    "message" => 'Email ou Senha Inválidos.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                "message" => 'Usuário Externo Inexistente.',
            ]);
        }

    }

    public function logout_index() {
        return view('usuarioMembro.sair.sair_membro');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect('/autenticacao/login_membro/login');
    }

}
