const el = (id) => document.getElementById(id);
let map;

function setCoor(latId, latValue, lngId, lngValue) {
    el(latId).value = latValue;
    el(lngId).value = lngValue;
}

function setMarker(marker, lat, lng) {
    marker.bindPopup("Area Lokasi: " + lat + ", " + lng).openPopup();
}

function displayMap(target, elementId) {
    const latId = target.getAttribute('data-form-lat-id');
    const lngId = target.getAttribute('data-form-lng-id');
    const currentLat = target.getAttribute('data-latitude');
    const currentLng = target.getAttribute('data-longitude');

    let marker;
    if (map) map.remove();

    if (!currentLng || !currentLat) {
        map = L.map(elementId).setView([1.0701, 104.0251], 12);
        setCoor(latId, null, lngId, null);
    } else {
        map = L.map(elementId).setView([currentLat, currentLng], 12);
        marker = L.marker({ lat: currentLat, lng: currentLng }).addTo(map);
        setMarker(marker, currentLat, currentLng);
        setCoor(latId, currentLat, lngId, currentLng);
    }

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    function onMapClick(e) {
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }

        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        setCoor(latId, lat, lngId, lng);
        setMarker(marker, lat, lng);
    }

    map.on('click', onMapClick);
}

document.onclick = async(e) => {
    let target = e.target;

    if (target.nodeName === 'BUTTON') {
        const action = target.getAttribute('data-action');
        if (!['EDIT', 'ADD'].includes(action)) return;

        const mapId = target.getAttribute('data-map-id');

        if (action === 'ADD') {
            displayMap(target, mapId);
            return;
        }

        let id = target.getAttribute('data-location-id');
        if (!id) return;

        el('name_edit').value = target.getAttribute('data-location-name');
        el('id').value = id;

        displayMap(target, mapId);
    }
}
