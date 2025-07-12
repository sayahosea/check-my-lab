<!DOCTYPE html>
<html lang="id">
<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Oubreak</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body class="bg-white min-h-screen flex items-end justify-center font-sans">

    <div class="flex items-center justify-end space-x-4 px-8 py-1 fixed top-0 inset-x-0">
        <div>
            <h1 class="text-2xl font-bold">PETA WABAH</h1>
        </div>
        <!-- Logo dan Teks -->
        <div class="flex items-center">
            <img src="{{ asset('/logo/puskesmas.png') }}" alt="Logo" class="w-20 h-20" />
            <span class="text-2xl font-bold text-black">CheckMyLab</span>
        </div>

        <!-- Tombol Log in -->
        <div class="group relative cursor-pointer">
            <div class="flex items-center justify-between space-x-5 bg-cyan-200 px-4 rounded ">
                <a class="menu-hover py-3 text-base font-semibold text-black lg:mx-4" onClick="">
                    Masuk
                </a>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </div>

            <div
                class="invisible absolute z-50 flex w-full flex-col bg-cyan-100 py-1 px-4 text-gray-800 shadow-xl group-hover:visible">

                <a href="{{ url('/login?akun=puskesmas') }}" class="my-2 block  border-gray-100 font-semibold text-gray-500 hover:text-black md:mx-2">
                    Puskesmas
                </a>

                <a href="{{ url('/login?akun=pasien') }}" class="my-2 block border-gray-100 font-semibold text-gray-500  hover:text-black md:mx-2">
                    Pasien
                </a>
            </div>
        </div>
    </div>

    <div id="map" style="width: 100vw; height: 85vh;"></div>
</body>
<script>
    const map = L.map('map').setView([1.0685, 104.0263], 12);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    @forelse($regions as $region)
        var marker = L.marker({ lat: {{ $region->latitude }} , lng: {{ $region->longitude }} }).addTo(map);

        var viruses = [];
        @forelse($outbreaks as $outbreak)
            @if($outbreak->region_id == $region->id)
                viruses.push(`{{ $outbreak->virus_name }}`);
            @endif
        @empty
        @endforelse

        marker.bindPopup(`<b>{{ $region->name }}</b><br>${viruses.length ? viruses.join(', ') : 'Tidak ada'}`);
    @empty
    @endforelse
</script>
</html>
