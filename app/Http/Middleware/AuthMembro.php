<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\TipoUsuarioEnum;
use Illuminate\Support\Facades\Auth;

class AuthMembro {

	public function handle(Request $request, Closure $next) {

		if (Auth::check() && Auth::user()->tipo == TipoUsuarioEnum::MEMBRO->value) {
			return $next($request);
		}
		
		return redirect()->route('login_membro_index');
	}

}