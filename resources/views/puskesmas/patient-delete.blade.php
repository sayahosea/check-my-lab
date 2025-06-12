@props([ "role" => null ])

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konfirmasi Hapus Akun</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans overflow-hidden">

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

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <div class="text-center">
                    <h1 class="text-2xl font-bold">Apakah Anda yakin ingin menghapus<br>akun dengan NIK {{ $nik }}?</h1><br>
                    <a href="{{ url('/patients/delete/' . $id . '?confirm=true') }}" class="btn btn-error btn-lg">Yakin</a>
                    <a href="{{ url('/patients') }}" class="btn btn-info btn-lg">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
