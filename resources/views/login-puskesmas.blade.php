<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>CheckMyTB Login</title>
</head>
<body  class="overflow-hidden w-screen h-screen">
    <div class="flex w-screen h-screen">

    <!-- gambar perawat -->
    <div class="w-3/4 flex items-center justify-center">
        <img src="perawat.jpg" alt="Perawat" class="w-[600px] h-auto">
    </div>

    <!-- gambar logo -->
    <div class="absolute top-1 right-7 space-x-7 text-xl font-bold text-black flex items-center">
        <img src="/logo/puskesmas.png" alt="Logo" class="w-auto h-15"> CheckMyLab
    </div>

    <!-- form login -->
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="w-80">
            <h2 class="text-center text-xl font-bold mb-2">MASUK AKUN</h2>
            <p class="text-center text-sm mb-6">Masukkan No Telepon dan Password Anda</p>

            <form action="/login?akun=puskesmas" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-4">
                    <div class="flex items-center bg-cyan-50 shadow-md rounded-xl px-4 py-2">
                        <span class="text-gray-400 mr-2"></span>
                        <input
                            name="phone_number"
                            type="tel" placeholder="No Telepon" class="w-full outline-none"
                            minlength="10" maxlength="14" pattern="^08\d{8,12}$"
                        />
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center bg-cyan-50 shadow-md rounded-xl px-4 py-2">
                        <span class="text-gray-400 mr-2"></span>
                        <input
                            name="password"
                            type="password" placeholder="Password" minlength="5" maxlength="32"
                            class="w-full outline-none text-gray-500"
                        />
                    </div>
                </div>

                <input type="submit" value="Login" class="w-full bg-cyan-200 hover:bg-cyan-500 text-black font-semibold py-2 rounded-xl shadow-md transition duration-300">
            </form>
        </div>
    </div>
</div>
</body>
</html>
