<div class=" mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Complaints for Your Barangay</h2>

    @if ($complaints->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Complainant Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Violation</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Violation Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Violation Time</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Proof
                            Image</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @foreach ($complaints as $complaint)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="border-b border-gray-200 px-6 py-4">{{ $complaint->name }}</td>
                            <td class="border-b border-gray-200 px-6 py-4">{{ $complaint->violation }}</td>
                            <td class="border-b border-gray-200 px-6 py-4">{{ $complaint->violation_date }}</td>
                            <td class="border-b border-gray-200 px-6 py-4">{{ $complaint->violation_time }}</td>
                            <td class="border-b border-gray-200 px-6 py-4">
                                @if ($complaint->proof_image)
                                    <a href="{{ asset('storage/' . $complaint->proof_image) }}" target="_blank"
                                        class="text-blue-600 hover:underline">View Proof</a>
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </td>
                            <td class="border-b border-gray-200 px-6 py-4">
                                @switch($complaint->status)
                                    @case('pending')
                                        <x-badge label="Pending" warning flat />
                                    @break

                                    @case('accepted')
                                        <x-badge label="Accepted" positive flat />
                                    @break

                                    @case('declined')
                                        <x-badge label="Declined" negative flat />
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="border-b border-gray-200 px-6 py-4">
                                @if ($complaint->status == 'pending')
                                    <div class="flex space-x-2">
                                        <button wire:click="acceptComplaint({{ $complaint->id }})"
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500">Accept</button>
                                        <button wire:click="declineComplaint({{ $complaint->id }})"
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500">Decline</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="mt-4 text-center text-gray-500">No complaints available for your barangay.</p>
    @endif
</div>
