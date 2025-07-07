<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-2xl font-bold">Terjadi Kesalahan</h1>
        <p class="text-lg">{{ $message }}</p>
        <a
            class="btn btn-wide btn-info mt-2"
            href="{{ $url }}"
        >
            Kembali
        </a>
    </div>
</body>
</html>
