@props([
    'message' => null,
    'role' => null
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daftar Hasil Uji</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-sidebar.pasien></x-sidebar.pasien>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold mb-4">Hasil Uji</h1>
                <div class="bg-white shadow rounded p-4">

                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Tanggal Pengiriman</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tests as $test)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $test->timestamp }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <a class="btn bg-success" href="/tests/view/{{ $test->test_id }}">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>

        <!-- Page Content -->
        <div class="flex items-center gap-4 mt-6 ml-6 mb-6">

            <!-- Search input with icon -->
            <div class="relative ml-10 w-full max-w-md">
                <input
                    type="text"
                    placeholder="Cari pasien"
                    class="w-full border border-gray-300 rounded px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto mt-8">
            <div class="overflow-x-auto">

                <!-- List of lab tests -->
                <table class="table">
                    <thead>
                        <tr class="*:font-medium *:text-gray-900">
                            <th class="px-3 py-2 whitespace-nowrap">Tanggal Pengiriman</th>
                            <th class="px-3 py-2 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($tests as $test)
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $test->timestamp }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <a class="btn bg-success" href="/tests/view/{{ $test->test_id }}">Lihat</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>
