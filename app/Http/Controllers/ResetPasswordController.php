<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm()
    {
        return view('reset_password/send_email_password');
    }

    public function sendEmailPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:Usuario,email',
        ], [
            'email.email' => 'O campo exige um email valido',
            'email.exists' => 'Este email não está cadastrado no sistema'
        ]);

        if(
            DB::table('password_reset_tokens')->where('email', $request->email)->exists()
        ) {
            return redirect()->to(route('reset_index'))->with("token", "Um token já foi criado e enviado para este email.");
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails/email_forget_password', ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('Redefinir Senha');
        });

        return redirect()->to(route('reset_index'))->with("success", "Um email foi encaminhado para redefinição de senha.");
    }

    public function resetPassword( String $token )
    {
        return view('reset_password/new_password', compact('token'));
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            "password" => 'required|string|min:8|confirmed',
            "password_confirmation" => 'required',
        ],
        [
            'password.string' => 'Senha: Deve ser um texto.',
            'password.min' => 'Senha: Deve conter no mínimo 8 caracteres.',
            'password.regex' => 'Senha: Deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
            'password.confirmed' => 'As senhas não são iguais'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where("token", $request->token)->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset_password', ['token' => $request->token]))
                                ->with('error', 'Solicitação de Redefinição Inválida');
        }
    
        Usuario::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);
    
        DB::table('password_reset_tokens')->where('email', $updatePassword->email)->delete();
    
        $usuario = Usuario::where('email', $updatePassword->email)->first(); // Aqui recupera o objeto Usuario
    
        if ($usuario->tipo === 'ALUNO') {
            return redirect()->to(route('login_estudante_index'))->with('success', 'Senha atualizada com sucesso');
        } else if ($usuario->tipo === 'PROFESSOR') {
            return redirect()->to(route('login_professor_index'))->with('success', 'Senha atualizada com sucesso');
        } else {
            return redirect()->to(route('login_membro_index'))->with('success', 'Senha atualizada com sucesso');
        }
    }
}
