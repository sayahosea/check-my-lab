@props([
    'message' => null,
    'role' => null
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Pasien</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    @if($role == 'MEDIS')
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
                @if($message)
                    <div class="toast toast-top toast-center text-white">
                        <div class="alert alert-success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @endif
                <h1 class="text-2xl font-bold text-black mb-4">Edit Akun Pasien</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/patients/edit') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <input
                            name="account_id" minlength="36" max="36"
                            value="{{ $patient_acc->account_id }}" class="input hidden"
                            readonly
                        />
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor ERM</legend>
                            <input
                                name="patient_erm" minlength="4" max="8" pattern="^ERM\d{4,8}$"
                                value="{{ $patient_acc->patient_erm }}" class="input"
                            />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">NIK</legend>
                            <input
                                name="nik" type="text" minlength="16" maxlength="16"
                                value="{{ $patient_acc->patient_nik }}" pattern="^[0-9]+$" class="input"
                            />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nama Lengkap</legend>
                            <input
                                name="full_name" type="text" minlength="3" maxlength="60"
                                value="{{ $patient_acc->full_name }}" class="input"
                            />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor WhatsApp</legend>
                            <input
                                name="phone_number"
                                type="tel" value="{{ $patient_acc->phone_number }}" class="input"
                                minlength="10" maxlength="14" pattern="^08\d{8,12}$"
                            />
                        </fieldset>
                        <input type="submit" class="btn mt-2 btn-wide" value="Ubah Data Akun">
                    </form>
                    <a class="btn mt-2 btn-wide btn-warning" href="{{ url('/patients') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
