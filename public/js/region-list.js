const el = (id) => document.getElementById(id);
const elName = (name) => document.getElementsByName(name)[0];
let map;

function setCoor(latValue, lngValue) {
    elName('latitude').value = latValue;
    elName('longitude').value = lngValue;
}

function setMarker(marker, lat, lng) {
    marker.bindPopup("Area Daerah: " + lat + ", " + lng).openPopup();
}

function displayMap(target, elementId) {
    const currentLat = target.getAttribute('data-latitude');
    const currentLng = target.getAttribute('data-longitude');

    let marker;
    if (map) map.remove();

    if (!currentLng || !currentLat) {
        map = L.map(elementId).setView([1.0701, 104.0251], 12);
        setCoor(null, null);
    } else {
        map = L.map(elementId).setView([currentLat, currentLng], 12);
        marker = L.marker({ lat: currentLat, lng: currentLng }).addTo(map);
        setMarker(marker, currentLat, currentLng);
        setCoor(currentLat, currentLng);
    }

    marker = L.marker({ lat: currentLat, lng: currentLng }).addTo(map);

    function onMapClick(e) {
        console.log(marker)
        marker.setLatLng(e.latlng);

        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        setCoor(lat, lng);
        setMarker(marker, currentLat, lng);
    }

    map.on('click', onMapClick);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
}

document.onclick = async(e) => {
    let target = e.target;

    if (target.nodeName === 'BUTTON') {
        const action = target.getAttribute('data-action');
        if (!['EDIT', 'ADD', 'DELETE'].includes(action)) return;

        let id = target.getAttribute('data-region-id');

        if (action === 'DELETE') {
            const name = target.getAttribute('data-region-name');
            el('delete_message').innerText = `Apakah Anda yakin ingin menghapus daerah ${name}?`;
            el('delete_link').setAttribute('href', `/outbreak/region/delete/${id}`);
            return;
        }

        const mapId = target.getAttribute('data-map-id');

        if (action === 'ADD') {
            displayMap(target, mapId);
            return;
        }

        if (!id) return;

        el('name_edit').value = target.getAttribute('data-region-name');
        el('id').value = id;

        displayMap(target, mapId);
    }
}
