<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
<div class="text-center">
    <h1 class="text-2xl font-bold">Anda Berhasil Keluar Akun</h1><br>
    <a
        class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:ring-3 focus:outline-hidden"
        href="{{ route('index') }}"
    >
        Kembali
    </a>
</div>
</body>
</html>
