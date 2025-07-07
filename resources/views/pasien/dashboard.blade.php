<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dasbor Pasien</title>
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

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">

                <h1 class="text-2xl font-bold mb-4">Selamat datang di Website UPT Puskesmas Baloi Permai!</h1>
                <div class="bg-white shadow rounded p-4">

                    <div class="flow-root">
                        <dl class="-my-3 divide-y divide-gray-200 text-sm">
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">NIK</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $patient->patient_nik }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Nama</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $user->full_name }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Nomor Telepon</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $user->phone_number }}</dd>
                            </div>
                        </dl>
                    </div>

                </div>

            </div>
        </main>
    </div>
</body>
</html>
