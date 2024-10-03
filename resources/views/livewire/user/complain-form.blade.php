<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Complainant Form</h2>

    <form wire:submit.prevent="submitComplaint" class="space-y-6" enctype="multipart/form-data">

        <div>
            <label for="barangay" class="block mb-2 text-sm font-medium text-gray-700">Select Barangay</label>
            <select wire:model="barangay" id="barangay" name="barangay"
                class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
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
            <label for="violation" class="block mb-2 text-sm font-medium text-gray-700">Type of Violation</label>
            <select wire:model="violation" id="violation" name="violation"
                class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                <option value="" disabled selected>Select Violation Type</option>
                <option>Littering</option>
                <option>Illegal Dumping</option>
                <option>Burning of Waste</option>
                <option>Improper Segregation</option>
            </select>
            @error('violation')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Date of Violation</label>
                <input wire:model="violation_date" type="date" id="date" name="date"
                    class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                @error('violation_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="time" class="block mb-2 text-sm font-medium text-gray-700">Time of Violation</label>
                <input wire:model="violation_time" type="time" id="time" name="time"
                    class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900">
                @error('violation_time')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div>
            <label for="proof" class="block mb-2 text-sm font-medium text-gray-700">Upload Proof (Image)</label>
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
