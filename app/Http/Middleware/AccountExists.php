<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;

class AccountExists
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $accountId = $request->attributes->get('account_id');
            $user = DB::table('user_accounts')->where('account_id', $accountId)->first();

            if (!$user) return redirect('/logout');

            $request->attributes->set('user', $user);

            if ($user->role == 'PASIEN') {
                $patient = DB::table('patient_accounts')->where('account_id', $accountId)->first();
                $request->attributes->set('patient', $patient);
            }

            return $next($request);
        } catch(QueryException $err) {
            return response()->view('error', [
                'message' => 'Basis data tidak mempunyai izin untuk melakukan hal ini',
                'url' => '/'
            ], 400);
        }
    }
}
