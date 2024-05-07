<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginProfessorController extends Controller
{
    public function index()
    {
        return view('autenticacaoUsuario/login_professor');   
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
    
        if ($user && $user->tipo === 'PROFESSOR') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('oferta_index');
            } else {
                return back()->withErrors([
                    "message" => 'Email ou Senha Inválidos.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                "message" => 'Acesso exclusivo para professores(as).',
            ]);
        }

    }

    public function logout_index() {
        return view('usuarioProfessor.sair.sair_professor');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->to(route('login_professor_index'))->with(Auth::logout());
    }

}
