@props([ 'role' => null ])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Pegawai</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

<!-- Sidebar -->
@if($role == "MEDIS")
    <x-sidebar.medis></x-sidebar.medis>
@else
    <x-sidebar.lab></x-sidebar.lab>
@endif

<!-- Main content area -->
<div class="ml-60 min-h-screen">
    <!-- Navbar -->
    <x-navbar></x-navbar>

    @if(session('alert_msg'))
        <div class="toast toast-top toast-center">
            <div class="alert {{ session('alert_color') }}">
                <span>{{ session('alert_msg') }}</span>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="ml-10 p-6">
        <div class="p-6 bg-gray-100">

            <h1 class="text-2xl font-bold text-black mb-4">Kelola Akun Pegawai</h1>
            <div class="bg-white shadow rounded p-4">

                <div class="max-w-4xl">

                    <div class="max-w-4xl mx-auto">

                        @if(count($locations) > 0)
                            <div class="overflow-x-auto">
                                <!-- List of patients -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($locations as $location)
                                        <tr>
                                            <td>{{ $location->location_name }}</td>
                                            <td>
                                                <a href="/outbreaks/edit/{{ $location->location_id }}">
                                                    <button class="btn btn-info">Ubah</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Belum ada daftar kecamatan</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
