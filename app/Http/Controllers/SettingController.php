<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\table;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $account = DB::table('accounts')->where('account_id', $session)->first();
        if (!$account) return redirect('/logout');

        $role = $account->role;
        if ($role == 'MEDIS' || $role == 'LAB') {
            return view('puskesmas.settings', ["account" => $account, "role" => $role]);
        } else {
            return view('pasien.settings', ["account" => $account, "role" => $role]);
        }
    }

    public function update(Request $request)
    {
        $acc_id = $request->session()->get('account_id');
        if (!$acc_id) return redirect('/');

        $account = DB::table('accounts')->where('account_id', $acc_id)->first();
        if (!$account) return redirect('/logout');

        $role = $account->role;
        if ($role == 'MEDIS' || $role == 'LAB') {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|string|min:10|max:20',
                'password' => 'nullable|string|min:5|max:128'
            ]);

            if ($validator->fails()) {
                return view(
                    'error',
                    ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/staffs']
                );
            }

            $phone_number = $request->input('phone_number');

            $other_account = DB::table('accounts')->where('phone_number', $phone_number)->first();
            if ($other_account && $other_account->account_id != $acc_id) {
                return view(
                    'error',
                    ['message'=>'Nomor telepon sudah digunakan oleh akun lain.', 'url'=>'/staffs']
                );
            }

            if ($request->input('password')) {
                $password = $request->input('password');
                $hashed = Utility::hashPassword($password);
            } else {
                $password = $account->password;
            }

            DB::table('accounts')
                ->where('account_id', $acc_id)
                ->update([
                    'phone_number' => $phone_number,
                    'password' => $hashed ?? $account->password
                ]);

            $account->phone_number = $phone_number;
            return view('puskesmas.settings', ["account" => $account, "message" => "Akun berhasil diperbarui.", "role" => $role]);
        } else {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|string|min:10|max:20'
            ]);

            if ($validator->fails()) {
                return view(
                    'error',
                    ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/staffs']
                );
            }

            $phone_number = $request->input('phone_number');
            $other_account = DB::table('accounts')->where('phone_number', $phone_number)->first();
            if ($other_account && $other_account->account_id != $acc_id) {
                return view(
                    'error',
                    ['message'=>'Nomor telepon sudah digunakan oleh akun lain.', 'url'=>'/staffs']
                );
            }

            DB::table('accounts')
                ->where('account_id', $acc_id)
                ->update([
                    'phone_number' => $phone_number
                ]);

            $account->phone_number = $phone_number;
            return view(
                'pasien.settings',
                ["account" => $account, "message" => "Akun berhasil diperbarui."]
            );
        }
    }
}
