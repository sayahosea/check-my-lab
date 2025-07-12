<?php

namespace App\Http\Controllers;

use App\Utils\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OutbreakController extends Controller
{
    public function index()
    {
        return 'a';
    }

    public function listRegion(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $regions = DB::table('outbreak_regions')->get();
        return view('outbreak.region.list', compact('role', 'regions'));
    }

    public function listViruses(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $viruses = DB::table('outbreak_viruses')->get();
        return view('outbreak.virus.list', compact('role', 'viruses'));
    }

    public function editVirus(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'name' => 'required|string|min:3|max:64'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data virus tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/virus');
        }

        $virus_name = $request->input('name');
        $virus = DB::table('outbreak_viruses')->where('name', $virus_name)->first();
        if ($virus && $virus->id != $request->input('id')) {
            session()->flash('alert_msg', 'Maaf, nama virus tersebut sudah digunakan');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/virus');
        }

        DB::table('outbreak_viruses')->where('id', $request->input('id'))->update([
            'name' => $virus_name
        ]);

        session()->flash('alert_msg', 'Data virus berhasil diubah');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/virus');
    }

    public function addVirus(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:64'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data virus tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/virus');
        }

        $virus_name = $request->input('name');
        $virus = DB::table('outbreak_viruses')->where('name', $virus_name)->first();
        if ($virus) {
            session()->flash('alert_msg', 'Maaf, nama virus tersebut sudah ada');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/virus');
        }

        DB::table('outbreak_viruses')->insert([
            'name' => $virus_name
        ]);

        session()->flash('alert_msg', 'Virus berhasil ditambahkan');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/virus');
    }

    public function deleteVirus(Request $request, string $id) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $virus = DB::table('outbreak_viruses')->where('id', $id)->first();
        if (!$virus) {
            session()->flash('alert_msg', 'Maaf, virus tidak ditemukan');
            session()->flash('alert_color', 'alert-error');
            return redirect('/outbreak/virus');
        }

        DB::table('outbreak_viruses')->where('id', $id)->delete();

        session()->flash('alert_msg', 'Virus ' . $virus->name . ' berhasil dihapus');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/virus');
    }

    public function editRegion(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'name' => 'required|string|min:3|max:64',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data daerah tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/region');
        }

        $region_name = $request->input('name');
        $region = DB::table('outbreak_regions')->where('name', $region_name)->first();
        if ($region && $region->id != $request->input('id')) {
            session()->flash('alert_msg', 'Maaf, nama daerah tersebut sudah digunakan');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/region');
        }

        DB::table('outbreak_regions')->where('id', $request->input('id'))->update([
            'name' => $region_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);

        session()->flash('alert_msg', 'Data daerah berhasil diubah');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/region');
    }

    public function addRegion(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:64',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data daerah tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/region');
        }

        $region_name = $request->input('name');
        $region = DB::table('outbreak_regions')->where('name', $region_name)->first();
        if ($region && $region->id != $request->input('id')) {
            session()->flash('alert_msg', 'Maaf, nama daerah tersebut sudah digunakan');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/region');
        }

        DB::table('outbreak_regions')->insert([
            'name' => $region_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);

        session()->flash('alert_msg', 'Daerah berhasil ditambahkan');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/region');
    }

    public function deleteRegion(Request $request, string $id) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $region = DB::table('outbreak_regions')->where('id', $id)->first();
        if (!$region) {
            session()->flash('alert_msg', 'Maaf, daerah tidak ditemukan');
            session()->flash('alert_color', 'alert-error');
            return redirect('/outbreak/region');
        }

        DB::table('outbreak_regions')->where('id', $id)->delete();

        session()->flash('alert_msg', 'Daerah ' . $region->name . ' berhasil dihapus');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/region');
    }
}
