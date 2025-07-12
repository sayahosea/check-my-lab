@props([ 'role' => null, 'title' => 'Kelola Daftar Virus' ])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

<!-- Sidebar -->
@if($role == "MEDIS")
    <x-sidebar.medis></x-sidebar.medis>
@else
    <x-sidebar.lab></x-sidebar.lab>
@endif

<!-- Main content area -->
<div class="ml-60 min-h-screen">
    <!-- Navbar -->
    <x-navbar></x-navbar>

    @if(session('alert_msg'))
        <div class="toast toast-top toast-center">
            <div class="alert {{ session('alert_color') }}">
                <span>{{ session('alert_msg') }}</span>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="ml-10 p-6">
        <div class="p-6 bg-gray-100">

            <h1 class="text-2xl font-bold text-black mb-4">{{ $title }}</h1>
            <div class="bg-white shadow rounded p-4">

                <div class="max-w-4xl">

                    <div class="max-w-4xl mx-auto">

                        <x-outbreak.virus.add></x-outbreak.virus.add>

                        <div class="mb-6">
                            <a href="/outbreak" class="btn btn-info">Lihat Peta</a>
                            <button
                                onclick="add_modal.showModal()"
                                data-action="ADD"
                                class="btn btn-success"
                            >Tambah Virus</button>
                            <a class="btn btn-success" href="/outbreak/region">Kelola Daerah</a>
                        </div>

                        @if(count($viruses) > 0)
                            <x-outbreak.virus.edit></x-outbreak.virus.edit>
                            <x-outbreak.delete></x-outbreak.delete>

                            <div class="overflow-x-auto">
                                <!-- List of patients -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Virus</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($viruses as $virus)
                                        <tr>
                                            <td>{{ $virus->name }}</td>
                                            <td>
                                                <button
                                                    onclick="edit_modal.showModal()"
                                                    class="btn btn-info"
                                                    data-action="EDIT"
                                                    data-virus-id="{{ $virus->id }}"
                                                    data-virus-name="{{ $virus->name }}"
                                                >Ubah</button>
                                                <button
                                                    onclick="delete_modal.showModal()"
                                                    class="btn btn-error"
                                                    data-action="DELETE"
                                                    data-virus-id="{{ $virus->id }}"
                                                    data-virus-name="{{ $virus->name }}"
                                                >Hapus</button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Belum ada data virus</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
<script src="{{ asset('js/virus-list.js') }}"></script>
</html>
