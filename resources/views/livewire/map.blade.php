<div>
    <div x-data="mapComponent()" x-init="init()">
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
    <script>
        function mapComponent() {
            return {
                map: null,
                markers: @json($markers), // Pass the markers data from Livewire to JavaScript
                markerLayers: [],
                scissorIcon: null,
                init() {
                    // Initialize Leaflet map
                    this.map = L.map('map').setView([13.9391454, 121.5879752], 13);

                    // Add the tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(this.map);

                    // Define a custom icon if needed (optional)
                    this.scissorIcon = L.icon({
                        iconUrl: '{{ asset('images/marker.png') }}',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    // Place initial markers on the map
                    this.updateMarkers(this.markers);
                },
                updateMarkers(markers) {
                    // Remove old markers from the map
                    this.markerLayers.forEach(layer => this.map.removeLayer(layer));
                    this.markerLayers = []; // Clear the array

                    // Add new markers
                    markers.forEach(marker => {
                        const markerLayer = L.marker([marker.latitude, marker.longitude], {
                                icon: this.scissorIcon
                            })
                            .addTo(this.map)
                            .bindPopup(`
                                <div>
                                    <h5>${marker.name}</h5>
                                    <p>Total Complaints: ${marker.complaints_count || '0'}</p>
                                </div>
                            `);
                        this.markerLayers.push(markerLayer);
                    });
                }
            };
        }
    </script>
</div>
