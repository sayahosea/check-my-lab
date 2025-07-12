@props([ 'role' => null, 'title' => 'Kelola Lokasi' ])

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
@if($role == 'MEDIS')
    <x-sidebar.medis></x-sidebar.medis>
@elseif($role == 'LAB')
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
        <div class="p-6 bg-gray-100 min-h-screen">

            <h1 class="text-2xl font-bold text-black mb-4">{{ $title }}</h1>
            <div class="bg-white shadow rounded p-4">

                <form action="{{ url('/outbreak/region/edit') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="fieldset hidden">
                        <legend class="fieldset-legend">ID Daerah</legend>
                        <input
                            name="id" value="{{ $region->id }}"
                            type="number" class="input" readonly required />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nama Daerah</legend>
                        <input
                            name="name" value="{{ $region->name }}"
                            minlength="3" maxlength="64"
                            type="text" class="input" required />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Pilih Pinpoint Daerah</legend>
                        <table>
                            <tr>
                                <td>
                                    <div id="map" style="height: 30vh;"></div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Latitude</legend>
                        <input
                            name="latitude" value="{{ $region->latitude }}"
                            type="number" class="input" readonly required />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Longitude</legend>
                        <input
                            name="longitude" value="{{ $region->longitude }}"
                            type="number" class="input" readonly required />
                    </fieldset>
                    @if(count($viruses) > 0)
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Wabah</legend>
                            <div class="flex">
                            @foreach($viruses as $virus)
                                <div class="mr-2">
                                @if(in_array($virus->id, $viruses_in_region))
                                    <label class="label">
                                        <input
                                            type="checkbox" class="checkbox" name="virus-{{ $virus->id }}"
                                            checked="checked" />
                                        {{ $virus->name }}
                                    </label>
                                @else
                                    <label class="label">
                                        <input
                                            type="checkbox" class="checkbox" name="virus-{{ $virus->id }}"
                                            />
                                        {{ $virus->name }}
                                    </label>
                                @endif
                                </div>
                            @endforeach
                            </div>
                        </fieldset>
                    @endif
                    <input type="submit" class="btn btn-info btn-block mt-2" value="Kirim">
                </form>
                <a class="btn mt-2 btn-block btn-error" href="{{ url('/outbreak/region') }}">Batal</a>
            </div>
        </div>
    </main>
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const el = (id) => document.getElementById(id);
    const elName = (name) => document.getElementsByName(name)[0];

    const currentLat = {{ $region->latitude }};
    const currentLng = {{ $region->longitude }};

    const map = L.map('map').setView([currentLat, currentLng], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    let marker = L.marker({ lat: currentLat, lng: currentLng }).addTo(map);
    setMarker(marker, currentLat, currentLng);

    function onMapClick(e) {
        marker.setLatLng(e.latlng);

        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        setCoor(lat, lng);
        setMarker(marker, currentLat, lng);
    }

    map.on('click', onMapClick);

    function setMarker(marker, lat, lng) {
        marker.bindPopup("Area Daerah: " + lat + ", " + lng).openPopup();
    }

    function setCoor(latValue, lngValue) {
        elName('latitude').value = latValue;
        elName('longitude').value = lngValue;
    }

</script>
</body>
</html>
