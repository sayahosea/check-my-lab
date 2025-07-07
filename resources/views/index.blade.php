<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CheckMyTB</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen flex items-center justify-center font-sans">
    <div class="flex items-center justify-end space-x-4 px-8 py-1 fixed top-0 inset-x-0">
        <!-- Logo dan Teks -->
        <div class="flex items-center">
            <img src="{{ asset('/logo/puskesmas.png') }}" alt="Logo" class="w-20 h-20" />
            <span class="text-2xl font-bold text-black">CheckMyLab</span>
        </div>

        <!-- Tombol Log in -->
        <div class="group relative cursor-pointer">
            <div class="flex items-center justify-between space-x-5 bg-cyan-200 px-4 rounded ">
                <a class="menu-hover py-3 text-base font-semibold text-black lg:mx-4" onClick="">
                    Masuk
                </a>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </div>

            <div
                class="invisible absolute z-50 flex w-full flex-col bg-cyan-100 py-1 px-4 text-gray-800 shadow-xl group-hover:visible">

                <a href="{{ url('/login?akun=puskesmas') }}" class="my-2 block  border-gray-100 font-semibold text-gray-500 hover:text-black md:mx-2">
                    Puskesmas
                </a>

                <a href="{{ url('/login?akun=pasien') }}" class="my-2 block border-gray-100 font-semibold text-gray-500  hover:text-black md:mx-2">
                    Pasien
                </a>
            </div>
        </div>
    </div>

    @if(session('alert_msg'))
    <div class="toast toast-top toast-center">
        <div class="alert {{ session('alert_color') }}">
            <span>{{ session('alert_msg') }}</span>
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <main class="flex flex-col-reverse md:flex-row items-center justify-center px-6 py-12 md:py-20 gap-6">

        <!-- Text content -->
        <div class="max-w-md text-center md:text-left">
            <h1 class="text-3xl md:text-3xl font-bold text-black mb-4">
                CheckMyLab
            </h1>
            <p class="text-black text-xl">
                Cek hasil uji laboratorium Anda secara online dengan mudah.
            </p>
        </div>

        <!-- Image -->
        <div>
            <img src="{{ asset('/img/landing_page.jpg') }}" alt="Ilustrasi pemeriksaan Laboratorium" class="max-w-md w-full" />
        </div>
    </main>
</body>
</html>
