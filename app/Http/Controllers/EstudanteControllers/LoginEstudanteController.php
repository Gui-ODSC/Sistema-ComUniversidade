<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginEstudanteController extends Controller
{
    public function index()
    {
        return view('autenticacaoUsuario/login_estudante');   
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
    
        if ($user && $user->tipo === 'ALUNO') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('lista_todas_ofertas_estudante');
            } else {
                return back()->withErrors([
                    "message" => 'Email ou Senha Inválidos.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                "message" => 'Acesso exclusivo para estudantes.',
            ]);
        }

    }

    public function logout_index() {
        return view('usuarioEstudante.sair.sair_estudante');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect()->route('login_estudante_index');
    }
}
