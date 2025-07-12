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

    public function listLocations(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $locations = DB::table('outbreak_locations')->get();
        return view('outbreak.location.list', compact('role', 'locations'));
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
        if ($virus) {
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

    public function editLocation(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'name' => 'required|string|min:3|max:64',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data lokasi tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/location');
        }

        $location_name = $request->input('name');
        $location = DB::table('outbreak_locations')->where('name', $location_name)->first();
        if ($location && $location->id != $request->input('id')) {
            session()->flash('alert_msg', 'Maaf, nama lokasi tersebut sudah digunakan');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/location');
        }

        DB::table('outbreak_locations')->where('id', $request->input('id'))->update([
            'name' => $location_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);

        session()->flash('alert_msg', 'Data lokasi berhasil diubah');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/location');
    }

    public function addLocation(Request $request) {
        $role = Utility::userRole($request);
        if ($role === 'PASIEN') return redirect('/dashboard');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:64',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            session()->flash('alert_msg', 'Maaf, data lokasi tidak valid');
            session()->flash('alert_color', 'alert-danger');
            return redirect('/outbreak/location');
        }

        $location_name = $request->input('name');
        $location = DB::table('outbreak_locations')->where('name', $location_name)->first();
        if ($location && $location->id != $request->input('id')) {
            session()->flash('alert_msg', 'Maaf, nama lokasi tersebut sudah digunakan');
            session()->flash('alert_color', 'alert-warning');
            return redirect('/outbreak/location');
        }

        DB::table('outbreak_locations')->insert([
            'name' => $location_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);

        session()->flash('alert_msg', 'Lokasi berhasil ditambahkan');
        session()->flash('alert_color', 'alert-success');
        return redirect('/outbreak/location');
    }
}
