<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use stdClass;

class PatientController extends Controller
{
    public function index(Request $request): RedirectResponse|View
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patients = $this->getFewPatients();
        return view('puskesmas.patient-list', compact('patients', 'role'));
    }

    public function showEditForm(Request $request, string $id)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patient_acc = DB::table('accounts')
            ->select(['patient_nik', 'phone_number'])
            ->where('role', 'PASIEN')
            ->where('account_id', $id)->first();

        if (!$patient_acc) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/patients']);

        return view('puskesmas.patient-edit', compact('patient_acc', 'id', 'role'));
    }

    public function showCreateForm(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/dashboard');

        return view('medis.patient-create');
    }

    public function update(Request $request)
    {
        $this->checkAuth($request);

        $validator = Validator::make($request->all(), [
            'id_account' => 'required|string|min:36|max:36',
            'nik' => 'required|string|min:16|max:16',
            'phone_number' => 'required|string|min:10|max:20'
        ]);

        if ($validator->fails()) {
            return view(
                'error',
                ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/patients']
            );
        }

        $id = $request->input('id_account');
        $nik = $request->input('nik');
        $phone_number = $request->input('phone_number');

        $account = DB::table('accounts')->where('account_id', $id)->first();
        if (!$account) {
            return view(
                'error',
                ['message'=>'Akun tidak ditemukan.', 'url'=>'/patients']
            );
        }

        // memastikan NIK baru belum dipakai akun lain
        $other_patient = DB::table('accounts')->where('patient_nik', $nik)->first();
        if ($other_patient && $other_patient->account_id != $id) {
            return view(
                'error',
                ['message'=>'NIK sudah digunakan oleh akun pasien lain.', 'url'=>'/patients']
            );
        }

        DB::table('accounts')
            ->where('account_id', $id)
            ->update([
                'patient_nik' => $nik,
                'phone_number' => $phone_number
            ]);

        $patient_acc = new stdClass();
        $patient_acc->patient_nik = $nik;
        $patient_acc->phone_number = $phone_number;

        $message = 'Akun pasien berhasil diperbarui.';
        return view(
            'puskesmas.patient-edit',
            compact('patient_acc', 'id', 'message')
        );
    }

    public function store(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|min:16|max:16',
            'phone_number' => 'required|string|min:10|max:20'
        ]);

        if ($validator->fails()) {
            return view(
                'error',
                ['message'=>'Informasi akun tidak valid. Mohon periksa kembali.', 'url'=>'/patients']
            );
        }

        $nik = $request->input('nik');
        $phone_number = $request->input('phone_number');

        $other_patient = DB::table('accounts')->where('patient_nik', $nik)->first();
        if ($other_patient) {
            return view(
                'error',
                ['message'=>'NIK sudah digunakan oleh akun pasien lain.', 'url'=>'/patients']
            );
        }

        $id = Str::uuid();
        DB::table('accounts')->insert([
            "account_id" => $id,
            "role" => "PASIEN",
            "patient_nik" => $nik,
            "phone_number" => $phone_number,
            "password" => null
        ]);

        $patients = $this->getFewPatients();
        $message = "Berhasil membuat akun pasien dengan NIK " . $nik . ".";
        return view('puskesmas.patient-list', compact('patients', 'message', 'role'));
    }

    public function delete(Request $request, string $id)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patient_acc = DB::table('accounts')
            ->select(['patient_nik', 'phone_number'])
            ->where('account_id', $id)->first();

        if (!$patient_acc) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/patients']);

        // Jika user mengklik tombol "Yakin" pada halaman konfirmasi
        $confirm = $request->query('confirm');
        if ($confirm == 'true') {
            DB::table('accounts')->where('account_id', $id)->delete();
            $patients = $this->getFewPatients();
            $message = "Akun " . $patient_acc->patient_nik . " berhasil dihapus";
            return view(
                'puskesmas.patient-list', compact('patients', 'message', 'role')
            );
        }

        $nik = $patient_acc->patient_nik;
        return view('puskesmas.patient-delete', ["nik" => $nik, "id" => $id, "role" => $role]);
    }


    public function checkAuth(Request $request) {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/');

        return null;
    }

    public function getFewPatients(): Collection
    {
        return DB::table('accounts')->where('role', 'PASIEN')->limit(8)->get();
    }
}
