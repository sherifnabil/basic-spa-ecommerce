<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OptionalAuthenticate
{
    public function handle($request, Closure $next): mixed
    {
        $header = $request->header('user-id');
        if (!empty($header)) {
            $user = User::find($header);
            if (!empty($user)) {
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
