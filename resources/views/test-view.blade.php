@props([
    'role' => null
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hasil Uji</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

<!-- Sidebar -->
@if($role == 'PASIEN')
    <x-sidebar.pasien></x-sidebar.pasien>
@elseif($role == 'MEDIS')
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
            <h1 class="text-2xl font-bold text-black">Hasil Uji</h1>
            <a href="{{ url('/tests/download/' . $test_result->test_id) }}" download>
                <button class="btn btn-success mb-4">Unduh Hasil Uji</button>
            </a>
            <div class="bg-white shadow rounded p-4">
                <object
                    data="data:application/pdf;base64,{{ $pdf }}" type="application/pdf"
                    width="100%" class="min-h-170">
                </object>
            </div>
        </div>
    </main>
</div>
</body>
</html>
