<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $account = $request->attributes->get('user');
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
        $account = $request->attributes->get('user');
        if (!$account) return redirect('/logout');

        $acc_id = $account->account_id;
        $role = $account->role;

        if ($role == 'MEDIS' || $role == 'LAB') {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|min:3|max:60',
                'phone_number' => 'required|string|min:10|max:20',
                'password' => 'nullable|string|min:5|max:128'
            ]);

            if ($validator->fails()) {
                session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
                session()->flash('alert_color', 'alert-error');
                return redirect('/settings');
            }

            $full_name = $request->input('full_name');
            $phone_number = $request->input('phone_number');

            $other_account = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
            if ($other_account && $other_account->account_id != $acc_id) {
                session()->flash('alert_msg', 'Nomor telepon sudah digunakan oleh akun lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/settings');
            }

            $plainPassword = $request->input('password');
            if ($plainPassword) {
                $hashed = Utility::hashPassword($plainPassword);
            }

            DB::table('user_accounts')
                ->where('account_id', $acc_id)
                ->update([
                    'full_name' => $full_name,
                    'phone_number' => $phone_number
                ]);

            if ($plainPassword) {
                DB::table('puskesmas_accounts')
                    ->where('account_id', $acc_id)
                    ->update([
                        'password' => $hashed
                    ]);
            }

            session()->flash('alert_msg', 'Data akun berhasil diperbarui');
            session()->flash('alert_color', 'alert-success');
            return redirect('/settings');

        } else {

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|min:3|max:60',
                'phone_number' => 'required|string|min:10|max:20'
            ]);

            if ($validator->fails()) {
                session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
                session()->flash('alert_color', 'alert-error');
                return redirect('/settings');
            }

            $full_name = $request->input('full_name');
            $phone_number = $request->input('phone_number');
            $other_account = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
            if ($other_account && $other_account->account_id != $acc_id) {
                session()->flash('alert_msg', 'Nomor telepon sudah digunakan oleh akun lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/settings');
            }

            DB::table('user_accounts')
                ->where('account_id', $acc_id)
                ->update([
                    'full_name' => $full_name,
                    'phone_number' => $phone_number
                ]);

            session()->flash('alert_msg', 'Data akun berhasil diperbarui');
            session()->flash('alert_color', 'alert-success');
            return redirect('/settings');
        }
    }
}
