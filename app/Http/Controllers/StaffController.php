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
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/dashboard');

        $staffs = $this->getFewStaffs();
        if ($staffs->count() < 2) $staffs = [];
        return view('medis.staff-list', compact('staffs'));
    }

    public function showCreateForm(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/dashboard');

        return view('medis.staff-create');
    }

    public function showEditForm(Request $request, string $id)
    {
        Utility::checkAuth($request);

        $staff_acc = DB::table('accounts')
            ->select(['role', 'phone_number'])
            ->where(function($query) {
                $query->where('role', 'LAB')
                    ->orWhere('role', 'MEDIS');
            })
            ->where('account_id', $id)->first();

        if (!$staff_acc) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/staffs']);

        $role = $staff_acc->role;
        return view('medis.staff-edit', compact('staff_acc', 'id', 'role'));
    }

    public function store(Request $request)
    {
        Utility::checkAuth($request);

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|min:10|max:20',
            'password' => 'required|string|min:5|max:128',
            'role' => 'required|string|in:MEDIS,LAB'
        ]);

        if ($validator->fails()) {
            return view(
                'error',
                ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/staffs']
            );
        }

        $phone_number = $request->input('phone_number');
        $password = $request->input('password');
        $role = $request->input('role');

        $other_account = DB::table('accounts')->where('phone_number', $phone_number)->first();
        if ($other_account) {
            return view(
                'error',
                ['message'=>'Nomor telepon sudah digunakan oleh akun lain.', 'url'=>'/staffs/create']
            );
        }

        $hashed = Utility::hashPassword($password);
        $id = Str::uuid();
        DB::table('accounts')->insert([
            "account_id" => $id,
            "role" => $role,
            "patient_nik" => null,
            "phone_number" => $phone_number,
            "password" => $hashed
        ]);

        $staffs = $this->getFewStaffs();
        $message = "Berhasil membuat akun staff dengan nomor telepon " . $phone_number . ".";
        return view('medis.staff-list', compact('staffs', 'message'));
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
            return view(
                'error',
                ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/staffs']
            );
        }

        $id = $request->input('id_account');
        $phone_number = $request->input('phone_number');
        $role = $request->input('role');

        $account = DB::table('accounts')->where('account_id', $id)->first();
        if (!$account) {
            return view(
                'error',
                ['message'=>'Akun tidak ditemukan.', 'url'=>'/staffs']
            );
        }

        $other_account = DB::table('accounts')->where('phone_number', $phone_number)->first();
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

        DB::table('accounts')
            ->where('account_id', $id)
            ->update([
                'phone_number' => $phone_number,
                'role' => $role,
                'password' => $hashed ?? $account->password
            ]);

        $staff_acc = new stdClass();
        $staff_acc->role = $role;
        $staff_acc->phone_number = $phone_number;

        $message = 'Akun ' . $role . ' berhasil diperbarui.';
        return view(
            'medis.staff-edit',
            compact('staff_acc', 'id', 'message')
        );
    }

    public function delete(Request $request, string $id)
    {
        Utility::checkAuth($request);
        $account = DB::table('accounts')
            ->select(['phone_number'])
            ->where('account_id', $id)->first();

        if (!$account) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/staffs']);

        // Jika user mengklik tombol "Yakin" pada halaman konfirmasi
        $confirm = $request->query('confirm');
        if ($confirm == 'true') {
            DB::table('accounts')->where('account_id', $id)->delete();
            $staffs = $this->getFewStaffs();
            $message = "Akun " . $account->phone_number . " berhasil dihapus";
            return view(
                'medis.staff-list', compact('staffs', 'message')
            );
        }

        return view('medis.staff-delete', ["phone_number" => $account->phone_number, "id" => $id]);
    }

    public function getFewStaffs(): Collection
    {
        return DB::table('accounts')
            ->select(['role', 'phone_number', 'account_id'])
            ->where('role', 'MEDIS')
            ->orWhere('role', 'LAB')->limit(8)
            ->get();
    }

    private function checkAuth(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/');

        echo "test123";
        return null;
    }
}
