<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use stdClass;

class AccountController extends Controller
{
    public function fetch(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return response('Bad Request', 400);

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'MEDIS' || $role != "LAB") return response('Bad Request', 400);

        return 'ok';
    }

    public static function fetchAllPatients(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return response('Bad Request', 400);

        $user = DB::table('user_accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        return DB::table('patients')
            ->join('test_results', 'patients.account_id', '=', 'test_results.account_id')
            ->get(['patients.account_id', 'patients.full_name', 'patients.patient_nik', 'patients.patient_erm'])
            ->unique();
    }

}
