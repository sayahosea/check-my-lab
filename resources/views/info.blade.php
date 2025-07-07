<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
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
