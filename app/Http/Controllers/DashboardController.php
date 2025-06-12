<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') {
            return view('pasien.dashboard');
        } else if ( $role == 'LAB' || $role == 'MEDIS') {
            $total_patients = $this->getPatientTotal();
            $total_tests = $this->getTestTotal();
            $total_staffs = $this->getStaffTotal();
            return view(
                strtolower($role) . '.dashboard',
                compact("total_patients", "total_tests", "total_staffs")
            );
        } else {
            return view('pages.error', ['message'=>'Akun tidak valid.']);
        }
    }

    private function getPatientTotal(): int
    {
        return DB::table('accounts')->where('role', 'PASIEN')->count();
    }

    private function getTestTotal(): int
    {
        return DB::table('test_results')->count();
    }

    private function getStaffTotal(): int
    {
        return DB::table('accounts')
            ->where('role', 'MEDIS')
            ->count();
    }
}
