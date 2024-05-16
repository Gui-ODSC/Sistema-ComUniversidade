<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\TipoUsuarioEnum;
use Illuminate\Support\Facades\Auth;

class AuthProfessor {

	public function handle(Request $request, Closure $next) {

		if (Auth::check() && Auth::user()->tipo == TipoUsuarioEnum::PROFESSOR->value) {
			return $next($request);
		}
		
		return redirect()->route('login_professor_index');
	}

}