<div x-data>
    <div class="flex justify-between items-end">
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
                <x-datetime-picker label="Date From" placeholder="" wire:model.live="date_from" without-timezone
                    without-time />
                <x-datetime-picker label="Date To" placeholder="" wire:model.live="date_to" without-timezone
                    without-time />

            </div>
        </div>
        <div>
            <x-button label="Print Report" icon="printer" slate class="font-semibold"
                @click="printOut($refs.printContainer.outerHTML);" />
        </div>
    </div>
    <div class="mt-10">
        <div x-ref="printContainer">
            <table id="example" style="width:100%">
                <thead class="font-normal">
                    <tr>
                        <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">NAME
                        </th>

                        <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                            BARANGAY
                        </th>
                        <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                            VIOLATION
                        </th>
                        <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                            DATE & TIME
                        </th>


                    </tr>
                </thead>
                <tbody class="">

                    @forelse ($complaints as $item)
                        <tr>
                            <td class="border border-gray-500  text-gray-700  px-3 py-1">
                                {{ $item->name }}
                            </td>
                            <td class="border border-gray-500  text-gray-700  px-3 py-1">
                                {{ $item->barangay->name }}
                            </td>
                            <td class="border border-gray-500  text-gray-700  px-3 py-1">
                                {{ $item->violation }}
                            </td>
                            <td class="border border-gray-500  text-gray-700  px-3 py-1">
                                {{ \Carbon\Carbon::parse($item->violation_date)->format('F d, Y') . ' ' . \Carbon\Carbon::parse($item->violation_time)->format('h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center border border-gray-500 py-2">
                                No Complaints Record
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
