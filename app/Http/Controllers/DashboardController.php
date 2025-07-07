<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role == 'PASIEN') {
            $patient = $request->attributes->get('patient');
            return view('pasien.dashboard', compact('patient', 'user'));
        }

        $total_patients = $this->getPatientTotal();
        $total_tests = $this->getTestTotal();
        $total_staffs = $this->getStaffTotal();
        return view(
            strtolower($role) . '.dashboard',
            compact("total_patients", "total_tests", "total_staffs")
        );
    }

    private function getPatientTotal(): int
    {
        return DB::table('patient_accounts')->count();
    }

    private function getTestTotal(): int
    {
        return DB::table('test_results')->count();
    }

    private function getStaffTotal(): int
    {
        return DB::table('puskesmas_accounts')
            ->count();
    }
}
