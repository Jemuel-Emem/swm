<div class="relative" wire:ignore x-data="mapData()" x-init="initMap()">
    <div id="map" style="height: 600px;"></div>

    <script>
        function mapData() {
            return {
                map: null,
                barangays: @json($barangays),
                geoJsonLayer: null,
                markers: [],
                barangayData: {}, // Stores additional data for each barangay

                initMap() {
                    this.map = L.map('map').setView([13.9312, 121.6173], 12);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(this.map);

                    this.loadGeoJsonData();

                    // Show all barangay markers on initial load
                    this.updateMarkers();
                },

                loadGeoJsonData() {
                    // Fetch GeoJSON file
                    fetch('{{ asset('images/lucena.geoJSON') }}')
                        .then(response => response.json())
                        .then(data => {
                            // Initialize barangay data for choropleth and exclude specific barangay
                            data.features.forEach(feature => {
                                if (feature.properties.name !== 'Bahay Pamahalaan ng Barangay Dalahican') {
                                    this.barangayData[feature.properties.name] = {
                                        population: feature.properties.population,
                                        violations: 0 // Initialize violation count to 0
                                    };
                                }
                            });

                            // Add GeoJSON layer to map
                            this.geoJsonLayer = L.geoJSON(data, {
                                style: feature => this.getFeatureStyle(feature),
                                onEachFeature: (feature, layer) => {
                                    // Bind a popup for each feature (e.g., polygon or line)
                                    if (feature.properties && feature.properties.name) {
                                        const barangay = this.barangays.find(b => b.name === feature
                                            .properties.name);
                                        const complaintsCount = barangay ? barangay.complaints_count : 0;

                                        layer.bindPopup(`
                                            <strong>${feature.properties.name}</strong><br>
                                            <strong>Complaints:</strong> ${complaintsCount}<br>
                                        `);

                                        // Add click event to open popup on click
                                        layer.on('click', function() {
                                            layer.openPopup();
                                        });

                                        layer.on('mouseover', () => {
                                            layer.setStyle({
                                                weight: 6,
                                                color: 'yellow',
                                                opacity: 1,
                                                fillColor: 'yellow',
                                                fillOpacity: 0.5
                                            });
                                        });

                                        layer.on('mouseout', () => {
                                            layer.setStyle(this.getFeatureStyle(feature));
                                        });
                                    }
                                }
                            }).addTo(this.map);
                        })
                        .catch(error => {
                            console.error('Error loading GeoJSON:', error);
                            alert("Failed to load map data.");
                        });
                },

                getFeatureStyle(feature) {
                    return {
                        color: 'green',
                        weight: 2,
                        opacity: 1,
                        fillColor: 'green',
                        fillOpacity: 0.3
                    };
                },

                updateMarkers() {
                    this.clearMarkers();
                    let bounds = [];

                    // Loop through all barangays and add markers
                    this.barangays.forEach(barangay => {
                        const marker = this.addMarker(barangay);
                        bounds.push([barangay.latitude, barangay.longitude]);
                    });

                    // Adjust map view to fit all markers
                    if (bounds.length > 0) {
                        this.map.fitBounds(bounds);
                    }

                    if (this.geoJsonLayer) {
                        this.geoJsonLayer.setStyle(feature => this.getFeatureStyle(feature));
                    }
                },

                clearMarkers() {
                    this.markers.forEach(marker => {
                        this.map.removeLayer(marker);
                    });
                    this.markers = [];
                },

                addMarker(barangay) {
                    const violationCount = this.barangayData[barangay.name] ? this.barangayData[barangay.name].violations :
                        0;


                    // Create the marker with the violation count
                    const marker = L.marker([barangay.latitude, barangay.longitude])
                        .bindPopup(`
                            <strong>${barangay.name}</strong><br>
                            Violations: ${violationCount}
                        `);

                    // Add click event to open the popup on marker click
                    marker.on('click', function() {
                        this.openPopup();
                    });

                    // Add the marker to the map and markers array
                    this.markers.push(marker);
                }
            };
        }
    </script>
</div>
