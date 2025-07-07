<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request) {
        $session = $request->session()->get('account_id');
        if (!$session) return redirect('/');

        $request->session()->forget('account_id');

        $request->session()->flash('alert_msg', 'Anda Berhasil Keluar Akun');
        $request->session()->flash('alert_color', 'alert-success');
        return redirect()->route('index');
    }
}
