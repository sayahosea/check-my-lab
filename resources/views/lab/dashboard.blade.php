<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard Laboran</title>
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

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold mb-4">Dashboard UPT Puskesmas Baloi Permai</h1>
                <!-- Statistik -->
                <x-statistics
                    total_patients="{{ $total_patients }}"
                    total_tests="{{ $total_tests }}"
                    total_staffs="{{ $total_staffs }}"
                ></x-statistics>
            </div>
        </main>
    </div>
</body>
</html>
