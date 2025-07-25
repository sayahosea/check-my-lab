<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Buat Akun Pasien</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.medis></x-sidebar.medis>

    @if(session('alert_msg'))
        <div class="toast toast-top toast-center">
            <div class="alert {{ session('alert_color') }}">
                <span>{{ session('alert_msg') }}</span>
            </div>
        </div>
    @endif

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold text-black mb-4">Buat Akun Pasien</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/patients/create') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nama Lengkap</legend>
                            <input
                                name="full_name" minlength="3" maxlength="60"
                                type="text" class="input"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor Induk Kependudukan</legend>
                            <input
                                name="nik" type="text" minlength="16" maxlength="16"
                                pattern="^[0-9]+$" class="input"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor WhatsApp</legend>
                            <input
                                name="phone_number"
                                type="tel" placeholder="08....." class="input"
                                minlength="10" maxlength="15" pattern="^08\d{8,15}$"
                                required
                            />
                        </fieldset>
                        <input type="submit" class="btn btn-info mt-2 btn-wide" value="Buat Akun">
                    </form>
                    <a class="btn mt-2 btn-wide btn-warning" href="{{ url('/patients') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
