<div x-data="mapData()" x-init="initMap()">
    <div class="grid grid-cols-2 gap-5 mx-auto max-w-7xl">
        <div class="p-6 bg-white rounded-lg">
            <h2 class="text-2xl font-bold text-left text-green-700 mb-6">Complainant Form</h2>

            <form wire:submit.prevent="submitComplaint" class="space-y-6" enctype="multipart/form-data">
                <div>
                    <label for="barangay" class="block mb-2 text-sm font-medium text-gray-700">Select Barangay</label>
                    <select wire:model="barangay" id="barangay" name="barangay"
                        class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900"
                        x-model="selectedBarangayId"
                        x-on:change="console.log('Barangay changed:', selectedBarangayId); updateMarkers()">
                        <option value="">Select Barangay</option>
                        @foreach ($barangays as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('barangay')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

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

        <div>
            <div>
                <div id="map" style="height: 600px;"></div>

                <script>
                    function mapData() {
                        return {
                            map: null,
                            barangays: @json($barangays), // Ensure this contains id, name, latitude, and longitude
                            selectedBarangayId: '', // Track selected barangay ID
                            markers: [], // Store markers for selected barangay

                            initMap() {
                                this.map = L.map('map').setView([13.9312, 121.6173], 12);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; OpenStreetMap contributors'
                                }).addTo(this.map);

                                this.addStaticPolygon();
                                this.addPolyline(); // Add the polyline
                                this.updateMarkers(); // Call initially to set the first marker if already selected
                            },

                            updateMarkers() {
                                console.log("Updating markers..."); // Debugging statement
                                // Clear existing markers
                                this.clearMarkers();

                                // Check if a barangay is selected
                                if (this.selectedBarangayId) {
                                    console.log("Selected Barangay ID:", this.selectedBarangayId); // Debugging statement

                                    // Find the barangay by ID
                                    const barangay = this.barangays.find(b => b.id == this.selectedBarangayId);
                                    console.log('Found Barangay:', barangay); // Debugging statement

                                    if (barangay) {
                                        this.addMarker(barangay); // Add marker for the selected barangay
                                    } else {
                                        console.warn('Barangay not found for ID:', this.selectedBarangayId); // Debugging line
                                    }
                                } else {
                                    // If no barangay is selected, revert to the original map view
                                    console.warn('No barangay selected, reverting to original map view'); // Debugging line
                                    this.revertToOriginalView();
                                }
                            },

                            clearMarkers() {
                                console.log("Clearing markers..."); // Debugging statement
                                // Remove all markers from the map
                                this.markers.forEach(marker => {
                                    this.map.removeLayer(marker);
                                });
                                this.markers = []; // Reset markers array
                            },

                            addMarker(barangay) {
                                console.log("Adding marker for barangay:", barangay); // Debugging statement
                                // Create a marker for the selected barangay
                                const marker = L.marker([barangay.latitude, barangay.longitude])
                                    .addTo(this.map)
                                    .bindPopup(barangay.name);
                                this.markers.push(marker); // Store the marker for future reference
                                this.map.setView([barangay.latitude, barangay.longitude], 14); // Center the map on the marker
                            },

                            revertToOriginalView() {
                                // Reset to the original map view
                                this.map.setView([13.9312, 121.6173], 12); // Original coordinates
                                this.clearMarkers(); // Clear any markers
                            },

                            addStaticPolygon() {
                                const staticPolygonCoordinates = [
                                    [13.9300, 121.6150],
                                    [13.9320, 121.6150],
                                    [13.9320, 121.6180],
                                    [13.9300, 121.6180],
                                    [13.9300, 121.6150] // Closing the polygon
                                ];


                            },

                            addPolyline() {
                                const lucenaPolylineCoordinates = [
                                    [13.9652, 121.5731], // Northwest (Near Tayabas)
                                    [13.9335, 121.5429], // West (Near Sariaya)
                                    [13.8932, 121.5528], // Southwest
                                    [13.8806, 121.6141], // South
                                    [13.8958, 121.6740], // Southeast
                                    [13.9302, 121.6854], // East (Near Pagbilao)
                                    [13.9758, 121.6530], // Northeast
                                    [13.9652, 121.5731] // Closing the polyline
                                ];

                                // Adding the polyline to the map
                                L.polyline(lucenaPolylineCoordinates, {
                                    color: 'green',
                                    fill: 'green',
                                    weight: 3, // Set the thickness of the polyline
                                    opacity: 0.7 // Set the opacity of the polyline
                                }).addTo(this.map);
                            }
                        };
                    }
                </script>
            </div>
        </div>
    </div>
</div>
