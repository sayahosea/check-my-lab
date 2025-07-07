<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Buat Akun Puskesmas</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.medis></x-sidebar.medis>

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
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold text-black mb-4">Buat Akun Puskesmas</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/staffs/create') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nama Lengkap</legend>
                            <input
                                name="full_name" minlength="3" maxlength="60"
                                type="text" class="input"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor Telepon</legend>
                            <input
                                name="phone_number"
                                type="tel" placeholder="08....." class="input"
                                minlength="10" maxlength="15" pattern="^08\d{8,15}$"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Kata Sandi</legend>
                            <input
                                name="password" type="password" minlength="5"
                                maxlength="32" class="input"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Peran</legend>
                            <select class="select" name="role" required>
                                <option value="MEDIS">Tim Rekam Medis</option>
                                <option value="LAB">Laboran</option>
                            </select>
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
