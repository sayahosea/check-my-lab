<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Unggah Hasil Uji</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">

</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.lab></x-sidebar.lab>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        @if(session('alert_msg'))
            <div class="toast toast-top toast-center">
                <div class="alert alert-error">
                    <span>{{ session('alert_msg') }}</span>
                </div>
            </div>
        @endif

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
                            <input type="file" class="file-input" name="file" accept=".pdf" required />
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
