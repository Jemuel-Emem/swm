<div x-data="mapData()" x-init="initMap()">
    <div class="grid grid-cols-2 gap-5 mx-auto max-w-7xl">
        <div class="p-6 bg-white rounded-lg">
            <h2 class="text-2xl font-bold text-left text-green-700 mb-6">Complainant Form</h2>
            <form wire:submit.prevent="submitComplaint" class="space-y-6" enctype="multipart/form-data">
                <div>
                    <label for="barangay" class="block mb-2 text-sm font-medium text-gray-700">Select Barangay</label>
                    <select wire:model="barangay" id="barangay" name="barangay"
                        class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900"
                        x-model="selectedBarangayName" x-on:change="updateMarkers()">
                        <option value="">Select Barangay</option>
                        @foreach ($barangays as $item)
                            <option value="{{ $item->name }}" x-bind:data-id="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('barangay')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hidden input to store selected barangay ID -->
                <input type="hidden" name="barangay" wire:model="barangay" x-bind:value="selectedBarangayId"
                    x-model="selectedBarangayId" />

                <div>
                    <label for="violation" class="block mb-2 text-sm font-medium text-gray-700">Type of
                        Violation</label>
                    <select wire:model="violation" id="violation" name="violation"
                        class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                        <option value="" selected>Select Violation Type</option>
                        @foreach ($violations as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('violation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Date of
                            Violation</label>
                        <input wire:model="violation_date" type="date" id="date" name="date"
                            class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                        @error('violation_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="time" class="block mb-2 text-sm font-medium text-gray-700">Time of
                            Violation</label>
                        <input wire:model="violation_time" type="time" id="time" name="time"
                            class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                        @error('violation_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="proof" class="block mb-2 text-sm font-medium text-gray-700">Upload Proof
                        (Image)</label>
                    <input wire:model="proof" type="file" id="proof" name="proof" accept="image/*"
                        class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                    @error('proof')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 text-white bg-green-600 hover:bg-green-700 rounded-lg font-semibold">
                        Submit Complaint
                    </button>
                </div>

            </form>
        </div>

        <div class="relative" wire:ignore>

            <div id="map" style="height: 600px;">

            </div>

            <script>
                function mapData() {
                    return {
                        map: null,
                        barangays: @json($barangays),
                        selectedBarangayName: '', // Track selected barangay name
                        selectedBarangayId: '', // Track selected barangay ID
                        geoJsonLayer: null,
                        markers: [],
                        barangayNames: [], // To store barangay names (excluding the specified one)
                        barangayData: {}, // To store additional data for each barangay


                        initMap() {

                            this.map = L.map('map').setView([13.9312, 121.6173], 12);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }).addTo(this.map);

                            this.loadGeoJsonData();
                            this.updateMarkers();


                        },

                        loadGeoJsonData() {
                            // Fetch GeoJSON file
                            fetch('{{ asset('images/lucena.geoJSON') }}')
                                .then(response => response.json())
                                .then(data => {
                                    // Initialize barangay data for choropleth and exclude the specified barangay
                                    data.features.forEach(feature => {
                                        // Exclude "Bahay Pamahalaan ng Barangay Dalahican"
                                        if (feature.properties.name !== 'Bahay Pamahalaan ng Barangay Dalahican') {
                                            this.barangayNames.push(feature.properties.name);

                                            // Initialize barangay data for choropleth with violation count
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
                                                // Retrieve violation count from the passed data
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
                                                    console.log(barangay.complaints_count);
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
                                .catch(error => console.error('Error loading GeoJSON:', error));
                        },


                        getFeatureStyle(feature) {
                            // Highlight style if this feature's name matches the selected barangay name
                            if (feature.properties.name === this.selectedBarangayName) {
                                return {
                                    color: 'yellow',
                                    weight: 4,
                                    opacity: 100,
                                    fillColor: 'yellow',
                                    fillOpacity: 0.5
                                };
                            }
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

                            if (this.selectedBarangayName) {
                                const barangay = this.barangays.find(b => b.name === this.selectedBarangayName);
                                if (barangay) {
                                    this.selectedBarangayId = barangay.id; // Update the ID based on the name
                                    this.addMarker(barangay);
                                }
                            } else {
                                this.revertToOriginalView();
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

                            // Log to check violation count for debugging
                            console.log(`Adding marker for ${barangay.name} with ${violationCount} violations`);

                            // Create the marker with the violation count
                            const marker = L.marker([barangay.latitude, barangay.longitude])
                                .bindPopup(`
            <strong>${barangay.name}</strong><br>
            Violations: ${violationCount}
        `); // Ensure the marker is added to the map here

                            // Ensure the popup opens when the marker is clicked
                            marker.on('click', function() {
                                this.openPopup(); // Use 'marker' directly to open the popup
                            });

                            // Add the marker to the markers array
                            this.markers.push(marker);
                            // Center the map on the selected marker
                            this.map.setView([barangay.latitude, barangay.longitude], 14);
                        },

                        revertToOriginalView() {
                            this.map.setView([13.9312, 121.6173], 12);
                            this.clearMarkers();
                        }
                    };

                }
            </script>




        </div>
    </div>
</div>
