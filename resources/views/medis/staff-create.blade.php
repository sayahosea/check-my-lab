<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Buat Akun Puskesmas</title>
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
    <x-sidebar.medis></x-sidebar.medis>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold text-black mb-4">Edit Akun Puskesmas</h1>
                <div class="bg-white shadow rounded p-4">
                    <form action="{{ url('/staffs/create') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Nomor Telepon</legend>
                            <input
                                name="phone_number"
                                type="tel" placeholder="08....." class="input"
                                minlength="10" maxlength="14" pattern="^08\d{8,12}$"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Kata Sandi</legend>
                            <input
                                name="password" type="password" minlength="5"
                                maxlength="64" class="input"
                                required />
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Peran</legend>
                            <select class="select" name="role" required>
                                <option value="MEDIS">Tim Rekam Medis</option>
                                <option value="LAB">Laboran</option>
                            </select>
                        </fieldset>
                        <input type="submit" class="btn btn-info mt-2 btn-wide" value="Buat Akun">
                    </form>
                    <a class="btn mt-2 btn-wide btn-warning" href="{{ url('/patients') }}">Batal</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
