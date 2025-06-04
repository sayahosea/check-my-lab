@props([
    'total_patients' => 0, 'total_tests' => 0, 'total_staffs' => 0
])

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 ">
    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
        <div>
            <p class="text-gray-600 text-sm">Total akun pasien</p>
            <h2 class="text-2xl font-bold">{{ $total_patients }}</h2>
        </div>
        <div class="text-purple-600 text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </div>
    </div>

    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
        <div>
            <p class="text-gray-600 text-sm">Total Hasil Uji TB</p>
            <h2 class="text-2xl font-bold">{{ $total_tests }}</h2>
        </div>
        <div class="text-purple-600 text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>
    </div>

    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
        <div>
            <p class="text-gray-600 text-sm">Total Akun pegawai</p>
            <h2 class="text-2xl font-bold">{{ $total_staffs }}</h2>
        </div>
        <div class="text-purple-600 text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
            </svg>
        </div>
    </div>
</div>
