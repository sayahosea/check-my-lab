<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $acc_id = $request->session()->get('account_id');

        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role == 'PASIEN') {
            $tests = DB::table('test_results as tr')
                ->join('test_trackers as tt', 'tr.test_id', '=', 'tt.test_id')
                ->where('tt.activity', 'RESULT_TIME')
                ->where('tr.account_id', $acc_id)
                ->select(['tr.test_id', 'tr.account_id', 'tt.timestamp'])
                ->get();
            return view('pasien.test-list', compact('tests'));
        }

        $patients = AccountController::fetchAllPatients($request);
        return view('puskesmas.test-list', compact('role', 'patients'));
    }

    public function view(Request $request, string $id)
    {
        $user = $request->attributes->get('user');
        if (!$user) return redirect('/logout');

        $role = $user->role;
        $test_result = DB::table('test_results')->where('test_id', $id)->first();

        if (!$test_result) {
            session()->flash('alert_msg', 'Hasil uji tidak ditemukan');
            return redirect('/tests');
        }

        $pdf = base64_encode($test_result->test_file);
        return view('test-view', compact('test_result', 'pdf', 'role'));
    }

    public function download(Request $request, string $id) {
        $user = $request->attributes->get('user');
        if (!$user) return redirect('/logout');

        $role = $user->role;
        $test_result = DB::table('test_results')->where('test_id', $id)->first();

        if (!$test_result) {
            session()->flash('alert_msg', 'File PDF tidak ditemukan' . $id);
            session()->flash('alert_color', 'alert-error');
            return redirect('/tests');
        }

        if ($test_result->account_id != $user->account_id && $role == 'PASIEN') {
            session()->flash('alert_msg', 'Anda tidak punya izin untuk melihat hasil uji itu');
            session()->flash('alert_color', 'alert-error');
            return redirect('/tests');
        }

        $pdf = $test_result->test_file;
        return response()->stream(function () use ($pdf) {
            echo $pdf;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . 'Hasil Uji' . '"',
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role != 'LAB') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|min:16|max:16',
            'file' => 'required|mimes:pdf|max:70240'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Data hasil uji tidak valid. Mohon periksa kembali');
            return redirect('/tests/upload');
        }

        $nik = $request->input('nik');

        $patient_acc = DB::table('patients')->where('patient_nik', $nik)->first();
        if (!$patient_acc) {
            session()->flash('alert_msg', 'Tidak ada akun pasien dengan NIK tersebut');
            return redirect('/tests/upload');
        }

        $file = $request->file('file');
        $fileContents = file_get_contents($file->getRealPath());

        $id = Str::random(10);

        DB::table('test_results')->insert([
            "test_id" => $id,
            "account_id" => $patient_acc->account_id,
            "test_file" => $fileContents
        ]);

        DB::table('test_trackers')->insert([
            "test_id" => $id,
            "activity" => "RESULT_TIME"
        ]);

        return redirect('/tests');
    }

    public function showUploadForm(Request $request)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role != 'LAB') return redirect('/dashboard');

        return view('lab.test-upload');
    }

    public function fetch(Request $request)
    {
        $account_id = $request->query('account_id');
        if (!$account_id) return '404';

        $tests = DB::table('test_results')
            ->join('patients', 'patients.account_id', '=', 'test_results.account_id')
            ->join('test_trackers', 'test_results.test_id', '=', 'test_trackers.test_id')
            ->where('test_trackers.activity', 'RESULT_TIME')
            ->select('test_results.test_id', 'patients.patient_erm', 'patients.patient_nik', 'test_trackers.timestamp')
            ->where('test_results.account_id', $account_id)
            ->get();
        return response()->json($tests);
    }


    public function showEditForm(Request $request, string $id)
    {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role == 'PASIEN') return redirect('/dashboard');

        $test = DB::table('test_results')->where('test_id', $id)->first();
        if (!$test) return view('error', ['message' => 'Data hasil uji tidak ditemukan.', 'url' => '/tests']);

        $nik = DB::table('patients')
            ->where('account_id', $test->account_id)
            ->select('patient_nik')->first();

        return view('puskesmas.test-edit', ['test' => $test, 'nik' => $nik]);
    }

    public function update(Request $request) {
        $user = $request->attributes->get('user');
        $role = $user->role;

        if ($role == 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'test_id' => 'required|string|min:10|max:10',
            'patient_nik' => 'required|string|min:16|max:16',
            'file' => 'nullable|mimes:pdf|max:70240'
        ]);

        $test_id = $request->input('test_id');

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Data hasil uji tidak valid. Mohon periksa kembali');
            session()->flash('alert_color', 'alert-error');
            return redirect('/tests/edit/' . $test_id);
        }

        $nik = $request->input('patient_nik');

        $nik_exists = DB::table('patients')->where('patient_nik', $nik)->first();
        if (!$nik_exists) {
            session()->flash('alert_msg', 'Tidak ada pasien dengan NIK ' . $nik);
            session()->flash('alert_color', 'alert-error');
            return redirect('/tests/edit/' . $test_id);
        }

        $patient_acc = DB::table('patients')->where('patient_nik', $nik)->first();

        $data = [ "test_id" => $test_id, "account_id" => $patient_acc->account_id ];

        $file = $request->file('file');
        if ($file) {
            $data['test_file'] = file_get_contents($file->getRealPath());
        }

        DB::table('test_results')
            ->where('test_id', $test_id)
            ->update($data);

        DB::table('test_trackers')->insert([
            "test_id" => $test_id,
            "activity" => "MODIFY_TIME"
        ]);

        session()->flash('alert_msg', 'Berhasil mengubah data hasil uji');
        session()->flash('alert_color', 'alert-success');
        return redirect('/tests/edit/' . $test_id);
    }

    public function delete(Request $request, $id) {
        $user = $request->attributes->get('user');
        $role = $user->role;
        if ($role == 'PASIEN') return redirect('/dashboard');

        $test = DB::table('test_results')->where('test_id', $id)->exists();
        if (!$test) {
            session()->flash('alert_msg', 'Tidak ada hasil uji');
            session()->flash('alert_color', 'alert-error');
            return redirect('/tests');
        }

        DB::table('test_trackers')->where('test_id', $id)->delete();
        DB::table('test_results')->where('test_id', $id)->delete();

        session()->flash('alert_msg', 'Berhasil menghapus data hasil uji');
        session()->flash('alert_color', 'alert-success');
        return redirect('/tests');
    }
}
