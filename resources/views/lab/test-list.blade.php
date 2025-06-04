@props([
    'message' => null
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Hasil Uji</title>
    @vite('resources/css/app.css')

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        .menu-item-hover {
            position: relative;
            overflow: hidden;
        }
        .menu-item-hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: currentColor;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease-out;
        }
        .menu-item-hover:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

<!-- Sidebar -->
<x-sidebar.lab></x-sidebar.lab>

<!-- Main content area -->
<div class="ml-60 min-h-screen">
    <!-- Navbar -->
    <x-navbar></x-navbar>

    @if($message)
        <div class="toast toast-top toast-center">
            <div class="alert alert-success">
                <span>{{ $message }}</span>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <div class="flex items-center gap-4 mt-6 ml-6 mb-6">

        <!-- Search input with icon -->
        <div class="relative ml-10 w-full max-w-md">
            <input
                type="text"
                placeholder="Cari hasil uji"
                class="w-full border border-gray-300 rounded px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>

        <!-- Tombol Tambah Pasien -->
        <a
            href="{{ url('/tests/upload') }}"
            class="flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold py-2 px-4 rounded border border-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Unggah Hasil Uji
        </a>

    </div>

    <div class="max-w-4xl mx-auto mt-8">
        <!-- Table -->
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-blue-100 text-gray-700 text-sm">
                <th class="px-4 py-2">NIK Pasien</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
            </thead>
            <tbody class="text-sm">
            <!-- Row -->
            @forelse($tests as $test)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $test->patient_nik }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center gap-2">
                            <a
                                href="/tests/view/{{ $test->test_id }}"
                                class="bg-yellow-400 text-white px-4 py-1 rounded shadow">Lihat</a>
                            <a
                                href="/tests/delete/{{ $test->test_id }}"
                                class="bg-red-500 text-white px-4 py-1 rounded shadow">Hapus</a>
                        </div>
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
