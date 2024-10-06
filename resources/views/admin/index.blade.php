<x-admin-layout>
    <div class="p-6">
        <div class="bg-white border-2 border-green-500 rounded-xl shadow-lg p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center shadow">
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-3" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.293 6.293a1 1 0 011.414 0l3.293 3.293a1 1 0 010 1.414l-3.293 3.293a1 1 0 01-1.414-1.414L11.586 10H5a1 1 0 010-2h6.586L9.293 6.293z" />
                        </svg>
                        @php
                            $barangayId = auth()->user()->barangay->id;
                            $totalComplaints = \App\Models\Comaplaints::where('barangay_id', $barangayId)->count();
                        @endphp
                        <h1 class="text-xl font-bold">Complaints</h1>
                        <h1 class="text-3xl font-extrabold text-green-600">{{ $totalComplaints }}</h1>
                    </div>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center shadow">
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-3" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M12.049 0a1.001 1.001 0 00-.998 1.014l.003.031c.014.2.045.392.088.576A5.007 5.007 0 017.89 6H4a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3.89a5.007 5.007 0 01-4.013-4.14c.184.043.376.074.576.088l.031.003a1 1 0 001.014-.998V2.049A1 1 0 0012.049 0zM6 8h6v6H6V8zm4 4h-2v-2h2v2z" />
                        </svg>
                        @php
                            $uniqueComplainants = \App\Models\Comaplaints::where('barangay_id', $barangayId)
                                ->distinct('user_id')
                                ->count('user_id');
                        @endphp
                        <h1 class="text-xl font-bold">Complainants</h1>
                        <h1 class="text-3xl font-extrabold text-green-600">{{ $uniqueComplainants }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
