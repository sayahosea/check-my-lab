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
        if ($session) return redirect('/dashboard');

        $account_type = $this->checkAccountType($request);
        // fallback to pasien page as default log in page
        if (!$account_type) return redirect('/login?akun=pasien');

        if ($account_type == 'pasien') return view('pasien.login');
        return view('puskesmas.login');
    }

    public function auth(Request $request)
    {
        $account_type = $this->checkAccountType($request);
        if (!$account_type) {
            session()->flash('alert_msg', 'Tipe akun tidak valid');
            return redirect('/login?akun=pasien');
        }

        if ($account_type == 'pasien') {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|string|min:16|max:16'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|string|min:10|max:15',
                'password' => 'required|string|min:5|max:32'
            ]);
        }

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
            return redirect('/login?akun=' . $account_type);
        }

        if ($account_type == 'pasien') {
            $nik = $request->input('nik');
            $user = DB::table('patient_accounts')->where('patient_nik', $nik)->first();
        } else {
            $user = DB::table('user_accounts')->where(
                'phone_number', $request->input('phone_number')
            )->first();
        }

        if ($user == null) {
            session()->flash('alert_msg', 'Maaf, akun tidak ditemukan');
            return redirect('/login?akun=' . $account_type);
        }

        if ($account_type == 'puskesmas') {
            $puskesmas = DB::table('puskesmas_accounts')
                ->select('password')
                ->where('account_id', $user->account_id)->first();

            if (!password_verify($request->input('password'), $puskesmas->password)) {
                session()->flash('alert_msg', 'Maaf, kata sandi yang Anda masukkan salah');
                return redirect('/login?akun=puskesmas');
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
