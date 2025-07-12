const map = L.map('map').setView([1.0685, 104.0263], 12);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const marker = L.marker([1.0059, 104.0099]).addTo(map)
    .bindPopup('<b>Kecamatan Sagulung</b><br />I am a popup.');

let popUp = false;
marker.on('click', () => {
    if (!popUp) marker.openPopup();
    if (popUp) marker.closePopup();
    popUp = !popUp;
});