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
            <img src="{{ asset('/img/perawat.jpg') }}" alt="Perawat" class="w-auto min-h-screen hidden lg:block">
        </div>

        <!-- gambar logo -->
        <div class="absolute top-1 right-7 space-x-7 text-xl font-bold text-black flex items-center">
            <img src="{{ asset('/logo/puskesmas.png') }}" alt="Logo" class="w-auto h-15"> CheckMyLab
        </div>

        @if(session('alert_msg'))
            <div class="toast toast-top toast-center">
                <div class="alert alert-error">
                    <span>{{ session('alert_msg') }}</span>
                </div>
            </div>
        @endif

        <!-- form login -->
        <div class="flex items-center justify-center h-screen w-screen">
            <div class="w-80">
                <h2 class="text-center text-xl font-bold mb-2">MASUK AKUN</h2>
                <p class="text-center text-sm mb-6">Silahkan ketik nomor telepon dan kata sandi Anda</p>

                <form action="{{ url('/login?akun=puskesmas') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nomor Telepon</legend>
                        <input
                            name="phone_number" placeholder="08..."
                            type="tel" class="input" pattern="^08\d{8,15}$"
                            minlength="10" maxlength="15"
                            required />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Kata Sandi</legend>
                        <input
                            name="password"
                            type="password" class="input"
                            minlength="5" maxlength="32"
                            required />
                    </fieldset>

                    <input type="submit" value="Masuk Akun" class="btn w-full btn-info mt-3">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
