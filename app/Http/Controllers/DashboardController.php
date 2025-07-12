<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

        $total_patients = Utility::getPatientTotal();
        $total_tests = Utility::getTestTotal();
        $total_staffs = Utility::getStaffTotal();
        return view(
            strtolower($role) . '.dashboard',
            compact("total_patients", "total_tests", "total_staffs")
        );
    }
}
