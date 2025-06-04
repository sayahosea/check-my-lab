<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Unggah Hasil Uji</title>
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

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.lab></x-sidebar.lab>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold text-black mb-4">Unggah Hasil Uji</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/tests/upload') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">NIK Pasien</legend>
                            <input
                                name="nik"
                                type="text" class="input"
                                minlength="16" maxlength="16"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <input type="file" class="file-input" name="file" required />
                        </fieldset>
                        <input type="submit" class="btn btn-info mt-2 btn-wide" value="Unggah">
                    </form>
                    <a class="btn mt-2 btn-wide btn-warning" href="{{ url('/tests') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
