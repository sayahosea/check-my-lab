@props([
    'role' => 'MEDIS'
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Puskesmas</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

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
            <div class="p-6 bg-gray-100">

                <h1 class="text-2xl font-bold text-black mb-4">Edit Akun Puskesmas</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/staffs/edit') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">ID Akun</legend>
                            <input
                                name="id_account" type="text" minlength="16" maxlength="16"
                                value="{{ $id }}" pattern="^[0-9]+$" class="input"
                                readonly />
                            <p class="label">Tidak dapat diubah</p>
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor Telepon</legend>
                            <input
                                name="phone_number"
                                type="tel" value="{{ $staff_acc->phone_number }}" class="input"
                                minlength="10" maxlength="14" pattern="^08\d{8,12}$"
                            />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Kata Sandi</legend>
                            <input
                                name="password" type="password" minlength="5"
                                maxlength="64" class="input"
                            />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Peran</legend>
                            <select class="select" name="role" required>
                                @if($role == 'MEDIS')
                                    <option value="MEDIS">Tim Rekam Medis</option>
                                    <option value="LAB">Laboran</option>
                                @else
                                    <option value="LAB">Laboran</option>
                                    <option value="MEDIS">Tim Rekam Medis</option>
                                @endif
                            </select>
                        </fieldset>
                        <input type="submit" class="btn mt-2 btn-wide" value="Ubah Data Akun">
                    </form>
                    <a class="btn mt-2 btn-wide btn-warning" href="{{ url('/staffs') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
