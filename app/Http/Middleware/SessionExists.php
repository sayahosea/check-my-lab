<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionExists
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $request->attributes->set('account_id', $session);

        return $next($request);
    }
}
