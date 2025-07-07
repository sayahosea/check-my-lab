<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use stdClass;

class StaffController extends Controller
{
    public function index(Request $request): RedirectResponse|View
    {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role != 'MEDIS') return redirect('/dashboard');

        $staffs = $this->getFewStaffs();
        if ($staffs->count() < 2) $staffs = [];
        return view('medis.staff-list', compact('staffs'));
    }

    public function showCreateForm(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/dashboard');

        return view('medis.staff-create');
    }

    public function showEditForm(Request $request, string $id)
    {
        Utility::checkAuth($request);

        $staff_acc = DB::table('puskesmas')
            ->select(['role', 'phone_number'])
            ->where(function($query) {
                $query->where('role', 'LAB')
                    ->orWhere('role', 'MEDIS');
            })
            ->where('account_id', $id)->first();

        if (!$staff_acc) {
            session()->flash('alert_msg', 'Akun tidak ditemukan');
            return redirect('/staffs');
        }

        $role = $staff_acc->role;
        return view('medis.staff-edit', compact('staff_acc', 'id', 'role'));
    }

    public function store(Request $request)
    {
        Utility::checkAuth($request);

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|min:3|max:60',
            'phone_number' => 'required|string|min:10|max:15',
            'password' => 'required|string|min:5|max:128',
            'role' => 'required|string|in:MEDIS,LAB'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali datanya');
            session()->flash('alert_color', 'alert-error');
            return redirect('/staffs/create');
        }

        $phone_number = $request->input('phone_number');

        $other_account = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
        if ($other_account) {
            session()->flash('alert_msg', 'Nomor telepon sudah digunakan oleh akun lain');
            session()->flash('alert_color', 'alert-error');
            return redirect('/staffs/create');
        }

        $role = $request->input('role');
        $password = $request->input('password');
        $hashed = Utility::hashPassword($password);

        if ($role == 'MEDIS') {
            // membuat akun tim rekam medis
            DB::select('CALL CreateMedicAccount(?, ?, ?)', [
                $request->input('full_name'),
                $request->get('phone_number'),
                $hashed
            ]);
        } else {
            // membuat akun laboran
            DB::select('CALL CreateLabAccount(?, ?, ?)', [
                $request->input('full_name'),
                $request->get('phone_number'),
                $hashed
            ]);
        }

        session()->flash('alert_msg', 'Berhasil Membuat Akun');
        session()->flash('alert_color', 'alert-success');
        return redirect('/staffs');
    }

    public function update(Request $request)
    {
        Utility::checkAuth($request);

        $validator = Validator::make($request->all(), [
            'id_account' => 'required|string|min:36|max:36',
            'phone_number' => 'required|string|min:10|max:20',
            'role' => 'required|string|in:MEDIS,LAB'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
            session()->flash('alert_color', 'alert-error');
            return redirect('/staffs');
        }

        $id = $request->input('id_account');
        $phone_number = $request->input('phone_number');
        $role = $request->input('role');

        $account = DB::table('user_accounts')->where('account_id', $id)->first();
        if (!$account) {
            return view(
                'error',
                ['message'=>'Akun tidak ditemukan.', 'url'=>'/staffs']
            );
        }

        $other_account = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
        if ($other_account && $other_account->account_id != $id) {
            return view(
                'error',
                ['message'=>'Nomor telepon sudah digunakan oleh akun lain.', 'url'=>'/staffs']
            );
        }

        $password = $request->input('password');
        if ($password) {
            if (strlen($password) < 4 || strlen($password) > 64) {
                return view(
                    'error',
                    ['message'=>'Kata sandi terlalu panjang atau terlalu pendek.', 'url'=>'/staffs']
                );
            } else {
                $hashed = Utility::hashPassword($password);
            }
        }

        DB::table('user_accounts')
            ->where('account_id', $id)
            ->update([
                'phone_number' => $phone_number,
                'role' => $role
            ]);

        if ($password) {
            DB::table('puskesmas_accounts')
                ->where('account_id', $id)
                ->update([
                    'password' => $hashed
                ]);
        }

        session()->flash('alert_msg', 'Akun ' . $role . ' berhasil diperbarui.');
        session()->flash('alert_color', 'alert-success');
        return redirect('/staffs');
    }

    public function delete(Request $request, string $id)
    {
        Utility::checkAuth($request);
        $account = DB::table('user_accounts')
            ->select(['phone_number', 'full_name'])
            ->where('account_id', $id)->first();

        if (!$account) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/staffs']);

        // Jika user mengklik tombol "Yakin" pada halaman konfirmasi
        $confirm = $request->query('confirm');
        if ($confirm == 'true') {
            DB::table('puskesmas_accounts')->where('account_id', $id)->delete();
            DB::table('user_accounts')->where('account_id', $id)->delete();

            session()->flash('alert_msg', "Akun " . $account->full_name . " berhasil dihapus.");
            session()->flash('alert_color', 'alert-success');
            return redirect('/staffs');
        }

        return view(
            'medis.staff-delete',
            ["account" => $account, "id" => $id]
        );
    }

    public function getFewStaffs(): Collection
    {
        return DB::table('puskesmas')
            ->select(['role', 'full_name', 'phone_number', 'account_id'])
            ->limit(8)
            ->get();
    }
}
