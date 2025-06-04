<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CheckMyTB</title>
    @vite('resources/css/app.css')

    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col justify-between font-sans">

<div class="flex items-center justify-end space-x-4 px-8 py-1">
    <!-- Logo dan Teks -->
    <div class="flex items-center ">
        <img src="/logo/puskesmas.png" alt="Logo" class="w-20 h-20" />
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

            <a href="/login?akun=puskesmas" class="my-2 block  border-gray-100 font-semibold text-gray-500 hover:text-black md:mx-2">
                Puskesmas
            </a>

            <a href="/login?akun=pasien" class="my-2 block border-gray-100 font-semibold text-gray-500  hover:text-black md:mx-2">
                Pasien
            </a>
        </div>
    </div>
</div>
</div>

<!-- Hero Section -->
<main class="flex flex-col-reverse md:flex-row items-center justify-center px-6 py-12 md:py-20 gap-6">

    <!-- Text content -->
    <div class="max-w-md text-center md:text-left">
        <h1 class="text-3xl md:text-3xl font-bold text-black mb-4">
            Cek Hasil Uji Laboratorium<br />Mu Disini!
        </h1>
        <p class="text-black text-base">
            Dapatkan hasil pemeriksaan Laboratorium kamu tanpa ribet!<br />
            Cek hasilmu secara online dengan mudah dan tetap terjaga kerahasiaannya.
        </p>
    </div>

    <!-- Image -->
    <div>
        <img src="landing_page.jpg" alt="Ilustrasi pemeriksaan Laboratorium" class="max-w-md w-full" />
    </div>
</main>
</body>
</html>
