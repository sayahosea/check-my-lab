@props([
    'message' => null,
    'role' => null
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Setelan Akun</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.pasien></x-sidebar.pasien>

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
                <h1 class="text-2xl font-bold text-black mb-4">Setelan Akun</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/settings') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nama Lengkap</legend>
                            <input
                                name="full_name"
                                type="text" value="{{ $account->full_name }}" class="input"
                                minlength="3" maxlength="60"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor Telepon</legend>
                            <input
                                name="phone_number"
                                type="tel" value="{{ $account->phone_number }}" class="input"
                                minlength="10" maxlength="14" pattern="^08\d{8,12}$"
                                required />
                        </fieldset>
                        <input type="submit" class="btn mt-2 btn-wide btn-success" value="Ubah Data Akun">
                    </form>
                    <a class="btn mt-2 btn-wide btn-error" href="{{ url('/dashboard') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
