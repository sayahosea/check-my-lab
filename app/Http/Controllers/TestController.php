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
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'LAB') return redirect('/dashboard');

        $tests = $this->getFewTests();
        return view('lab.test-list', compact('tests'));
    }

    public function store(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'LAB') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|min:16|max:16',
            'file' => 'required|mimes:pdf|max:70240'
        ]);

        if ($validator->fails()) {
            return view(
                'error',
                ['message'=>'Data hasil uji tidak valid. Mohon periksa kembali.', 'url'=>'/tests/upload']
            );
        }

        $nik = $request->input('nik');

        $nik_exists = DB::table('accounts')->where('patient_nik', $nik)->first();
        if (!$nik_exists) {
            return view('error', ['message'=>'NIK tidak ditemukan.', 'url'=>'/tests/upload']);
        }

        $file = $request->file('file');
        $fileContents = file_get_contents($file->getRealPath());

        $id = Str::random(10);
        DB::table('test_results')->insert([
            "test_id" => $id,
            "patient_nik" => $nik,
            "test_file" => $fileContents
        ]);

        DB::table('test_trackers')->insert([
            "test_id" => $id,
        ]);

        return redirect('/tests');
    }

    public function showUploadForm(Request $request)
    {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $user = DB::table('accounts')->where('account_id', $session)->first();
        if (!$user) return redirect('/logout');

        $role = $user->role;
        if ($role != 'LAB') return redirect('/dashboard');

        return view('lab.test-upload');
    }

    private function getFewTests()
    {
        return DB::table('test_results')->limit(8)->get();
    }
}
