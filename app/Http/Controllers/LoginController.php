<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session()->get('account_id');
        if ($session) {
            return redirect('/dashboard');
        }

        $account_type = $this->checkAccountType($request);
        if (!$account_type) return view('pages.error', ['message'=>'Tipe akun tidak valid.']);

        if ($account_type == 'pasien') return view('login-pasien');
        return view('login-puskesmas');
    }

    public function authenticate(Request $request)
    {
        $account_type = $this->checkAccountType($request);
        if (!$account_type) return view('error', ['message'=>'Tipe akun tidak valid.', 'url'=>'/']);

        if ($account_type == 'pasien') {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|string|min:16|max:16'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|string|min:10|max:20',
                'password' => 'required|string|min:5|max:128'
            ]);
        }

        if ($validator->fails()) return view(
            'error',
            ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/login?akun=' . $account_type]
        );

        if ($account_type == 'pasien') {
            $nik = $request->input('nik');
            $user = DB::table('accounts')->where('patient_nik', $nik)->first();
        } else {
            $user = DB::table('accounts')->where(
                'phone_number', $request->input('phone_number')
            )->first();
        }

        if ($user == null) {
            return view(
                'error',
                ['message'=>'Maaf, akun tidak ditemukan.', 'url'=>'/login?akun=' . $account_type]
            );
        }

        if ($account_type == 'puskesmas') {
            $hashed = $user->password;
            if (!password_verify($request->input('password'), $hashed)) {
                return view(
                    'error',
                    ['message'=>'Maaf, kata sandi salah.', 'url'=>'/login?akun=' . $account_type]
                );
            }
        }

        $request->session()->put('account_id', $user->account_id);
        return redirect()->route('dashboard');
    }

    private function checkAccountType(Request $request): ?string
    {
        $account_type = $request->query('akun');
        if ($account_type == 'pasien') {
            return 'pasien';
        } else if ($account_type == 'puskesmas') {
            return 'puskesmas';
        } else {
            return null;
        }
    }
}
