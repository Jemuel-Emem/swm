<x-admin-layout>
    <div>

        <div class=" p-6">
            <div class="grid grid-cols-4 gap-5">
                <div class="bg-white border-2 shadow border-green-500 rounded-xl p-5">
                    <p class="text-xl font-semibold text-gray-700 uppercase">Littering</p>
                    <div class="mt-5 border-t flex justify-between items-center">
                        @php

                            $accept = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Littering')
                                ->where('status', 'accepted')
                                ->count();

                            $decline = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Littering')
                                ->where('status', 'declined')
                                ->count();
                        @endphp
                        <div class="text-center">
                            <h1>ACCEPTED</h1>
                            <h1>{{ $accept }}</h1>
                        </div>
                        <div class="text-center">
                            <h1>DECLINE</h1>
                            <h1>{{ $decline }}</h1>
                        </div>

                    </div>
                </div>
                <div class="bg-white border-2 shadow border-green-500 rounded-xl p-5">
                    <p class="text-xl font-semibold text-gray-700 uppercase">Illegal Dumping</p>
                    <div class="mt-5 border-t flex justify-between items-center">
                        @php

                            $accept = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Illegal Dumping')
                                ->where('status', 'accepted')
                                ->count();

                            $decline = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Illegal Dumping')
                                ->where('status', 'declined')
                                ->count();
                        @endphp
                        <div class="text-center">
                            <h1>ACCEPTED</h1>
                            <h1>{{ $accept }}</h1>
                        </div>
                        <div class="text-center">
                            <h1>DECLINE</h1>
                            <h1>{{ $decline }}</h1>
                        </div>

                    </div>
                </div>
                <div class="bg-white border-2 shadow border-green-500 rounded-xl p-5">
                    <p class="text-xl font-semibold text-gray-700 uppercase">Burning of Waste</p>
                    <div class="mt-5 border-t flex justify-between items-center">
                        @php

                            $accept = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Burning of Waste')
                                ->where('status', 'accepted')
                                ->count();

                            $decline = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Burning of Waste')
                                ->where('status', 'declined')
                                ->count();
                        @endphp
                        <div class="text-center">
                            <h1>ACCEPTED</h1>
                            <h1>{{ $accept }}</h1>
                        </div>
                        <div class="text-center">
                            <h1>DECLINE</h1>
                            <h1>{{ $decline }}</h1>
                        </div>

                    </div>
                </div>
                <div class="bg-white border-2 shadow border-green-500 rounded-xl p-5">
                    <p class="text-xl font-semibold text-gray-700 uppercase">Improper Segregation</p>
                    <div class="mt-5 border-t flex justify-between items-center">
                        @php

                            $accept = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Improper Segregation')
                                ->where('status', 'accepted')
                                ->count();

                            $decline = \App\Models\Comaplaints::where('barangay_id', auth()->user()->barangay->id)
                                ->where('violation', 'Improper Segregation')
                                ->where('status', 'declined')
                                ->count();
                        @endphp
                        <div class="text-center">
                            <h1>ACCEPTED</h1>
                            <h1>{{ $accept }}</h1>
                        </div>
                        <div class="text-center">
                            <h1>DECLINE</h1>
                            <h1>{{ $decline }}</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
