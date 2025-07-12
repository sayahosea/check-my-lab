@props([ 'role' => null, 'title' => 'Kelola Lokasi Wabah' ])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

                        <x-outbreak.location.add></x-outbreak.location.add>

                        <div class="mb-6">
                            <button
                                onclick="add_modal.showModal()"
                                data-action="ADD"
                                data-map-id="map2"
                                data-form-lat-id="lat_add"
                                data-form-lng-id="lng_add"
                                class="btn btn-success"
                            >Tambah Lokasi</button>
                            <a class="btn btn-info" href="/outbreak/virus">Kelola Virus</a>
                        </div>

                        @if(count($locations) > 0)
                            <x-outbreak.location.edit></x-outbreak.location.edit>

                            <div class="overflow-x-auto">
                                <!-- List of patients -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Daerah</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($locations as $location)
                                        <tr>
                                            <td>{{ $location->name }}</td>
                                            <td>
                                                <button
                                                    onclick="edit_modal.showModal()"
                                                    class="btn btn-info"
                                                    data-action="EDIT"
                                                    data-map-id="map"
                                                    data-form-lat-id="lat_edit"
                                                    data-form-lng-id="lng_edit"
                                                    data-location-id="{{ $location->id }}"
                                                    data-location-name="{{ $location->name }}"
                                                    data-latitude="{{ $location->latitude }}"
                                                    data-longitude="{{ $location->longitude }}"
                                                >Kelola</button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Belum ada daftar lokasi</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/location-list.js') }}"></script>
</html>
