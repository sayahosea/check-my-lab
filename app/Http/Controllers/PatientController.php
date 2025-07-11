<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index(Request $request): RedirectResponse|View
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patients = $this->getFewPatients();
        return view('puskesmas.patient-list', compact('patients', 'role'));
    }

    public function updateForm(Request $request, string $account_id)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patient_acc = DB::table('patients')
            ->select(['account_id', 'patient_nik', 'phone_number', 'patient_erm', 'full_name'])
            ->where('account_id', $account_id)->first();

        if (!$patient_acc) return view('error', ['message' => 'Akun tidak ditemukan.', 'url' => '/patients']);

        return view('puskesmas.patient-edit', compact('patient_acc', 'account_id', 'role'));
    }

    public function update(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'account_id' => 'required|string|exists:patient_accounts,account_id',
            'patient_erm' => 'nullable|string|min:4|max:8',
            'nik' => 'nullable|string|min:16|max:16',
            'full_name' => 'nullable|string|min:3|max:60',
            'phone_number' => 'nullable|string|min:10|max:15'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
            session()->flash('alert_color', 'alert-error');
            return redirect('/patients');
        }

        $account_id = $request->input('account_id');
        $patient_erm = $request->input('patient_erm');
        $nik = $request->input('nik');
        $full_name = $request->input('full_name');
        $phone_number = $request->input('phone_number');

        $account = DB::table('patients')->where('account_id', $account_id)->first();
        if (!$account) {
            session()->flash('alert_msg', 'Akun tidak ditemukan');
            session()->flash('alert_color', 'alert-error');
            return redirect('/patients');
        }

        if ($nik) {
            // memastikan NIK baru belum dipakai akun lain
            $other_patient = DB::table('patients')->where('patient_nik', $nik)->first();
            if ($other_patient && $other_patient->patient_erm != $patient_erm) {
                session()->flash('alert_msg', 'NIK sudah digunakan oleh akun pasien lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/patients');
            }
        }

        if ($phone_number) {
            $phone_number_taken = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
            if ($phone_number_taken && $phone_number_taken->account_id != $account_id) {
                session()->flash('alert_msg', 'Nomor telepon sudah digunakan oleh akun lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/patients');
            }
        }

        DB::table('user_accounts')
            ->where('account_id', $account->account_id)
            ->update([
                'full_name' => $full_name,
                'phone_number' => $phone_number
            ]);

        DB::table('patient_accounts')
            ->where('account_id', $account->account_id)
            ->update([
                'patient_erm' => $patient_erm,
                'patient_nik' => $nik
            ]);

        session()->flash('alert_msg', 'Akun pasien berhasil diperbarui');
        session()->flash('alert_color', 'alert-success');
        return redirect('/patients');
    }

    public function storeForm(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role != 'MEDIS') return redirect('/dashboard');

        return view('medis.patient-create');
    }

    public function store(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'patient_erm' => 'nullable|string|min:4|max:8',
            'full_name' => 'nullable|string|min:3|max:60',
            'nik' => 'nullable|string|min:16|max:16',
            'phone_number' => 'nullable|string|min:10|max:15'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Informasi akun tidak valid. Mohon periksa kembali');
            session()->flash('alert_color', 'alert-error');
            return redirect('/patients');
        }

        $patient_erm = $request->input('patient_erm');
        if ($patient_erm) {
            $other_patient = DB::table('patients')->where('patient_erm', $patient_erm)->first();
            if ($other_patient) {
                session()->flash('alert_msg', 'Nomor ERM sudah digunakan oleh akun pasien lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/patients');
            }
        }

        $nik = $request->input('nik');
        if ($nik) {
            $other_patient = DB::table('patients')->where('patient_nik', $nik)->first();
            if ($other_patient) {
                session()->flash('alert_msg', 'NIK sudah digunakan oleh akun pasien lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/patients');
            }
        }

        $phone_number = $request->input('phone_number');
        if ($phone_number) {
            $phone_number_taken = DB::table('user_accounts')->where('phone_number', $phone_number)->first();
            if ($phone_number_taken) {
                session()->flash('alert_msg', 'Nomor telepon sudah digunakan oleh akun lain');
                session()->flash('alert_color', 'alert-error');
                return redirect('/patients');
            }
        }

        DB::select('CALL sp_create_patient_account(?, ?, ?, ?)', [
            $request->input('full_name'),
            $phone_number,
            $nik,
            $patient_erm
        ]);

        session()->flash('alert_msg', 'Berhasil membuat akun pasien dengan NIK ' . $nik);
        session()->flash('alert_color', 'alert-success');
        return redirect('/patients');
    }

    public function delete(Request $request, string $id)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $patient_acc = DB::table('patients')
            ->select(['patient_nik', 'phone_number'])
            ->where('account_id', $id)->first();

        if (!$patient_acc) return view('error', ['message'=>'Akun tidak ditemukan.', 'url'=>'/patients']);

        // Jika user mengklik tombol "Yakin" pada halaman konfirmasi
        $confirm = $request->query('confirm');
        if ($confirm == 'true') {

            DB::table('patient_accounts')->where('account_id', $id)->delete();
            DB::table('test_results')->where('account_id', $id)->delete();
            DB::table('user_accounts')->where('account_id', $id)->delete();


            session()->flash('alert_msg', "Akun " . $patient_acc->patient_nik . " berhasil dihapus");
            session()->flash('alert_color', 'alert-success');
            return redirect('/patients');
        }

        $nik = $patient_acc->patient_nik;
        return view('puskesmas.patient-delete', ["nik" => $nik, "id" => $id, "role" => $role]);
    }

    public function fetch(Request $request) {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PATIENT') return response()->json(['error' => 'Bad Request'], 400);

        $page = $request->query('page');
        if (!$page) return response()->json(['error' => 'Not Found'], 404);

        $page = (int) $page;
        if (!is_numeric($page)) {
            if (!$page) return response()->json(['error' => 'Not Found'], 404);
        }

        // if filter and search query are provided
        $filter = $request->query('filter');
        $query = $request->query('query');
        if ($filter && $query) {
            return DB::table('patients')
                ->where($filter, 'like', $query . '%')
                ->select(['account_id', 'patient_erm', 'patient_nik', 'phone_number', 'full_name'])
                ->limit(8)
                ->offset(($page - 1) * 8)
                ->get();
        }

        return DB::table('patients')
            ->limit(8)
            ->offset(($page - 1) * 8)
            ->get();
    }

    public function verify(Request $request) {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PATIENT') return response()->json(['error' => 'Bad Request'], 400);

        $account_id = $request->query('account_id');
        if (!$account_id) return response()->json(['error' => 'Bad Request'], 400);
        if (strlen($account_id) != 36) return response()->json(['error' => 'Bad Request'], 400);

        $checked = $request->query('checked');
        if (!$checked) return response()->json(['error' => 'Bad Request'], 400);
        if ($checked !== 'true' && $checked !== 'false') return response()->json(['error' => 'Bad Request'], 400);

        $patient = DB::table('patients')->where('account_id', $account_id)->first();
        if (!$patient) return response()->json(['error' => 'Bad Request'], 400);

        DB::table('patient_accounts')
            ->where('account_id', $account_id)
            ->update([
                'info_verified' => $checked === 'true' ? 1 : 0,
            ]);

        return response()->json(['message' => 'OK']);
    }

    public function getFewPatients(): Collection
    {
        return DB::table('patients')->limit(8)->get();
    }
}
