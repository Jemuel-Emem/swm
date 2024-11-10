<div>
    <div class="p-5 ">
        <h1 class="text-2xl font-bold text-gray-700 uppercase">Complain Status</h1>
        <div class="mt-10 grid grid-cols-2 gap-5">
            @forelse ($complaints as $item)
                <article
                    class="group grid rounded-md max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                    <!-- image -->
                    <div class="col-span-3 overflow-hidden">
                        <a href="{{ Storage::url($item->proof_image) }}" target="_blank">
                            <img src="{{ Storage::url($item->proof_image) }}"
                                class="h-52 md:h-full w-full  object-cover transition duration-700 ease-out group-hover:scale-105"
                                alt="a men wearing VR goggles" />
                        </a>
                    </div>
                    <!-- body -->
                    <div class="flex flex-col justify-center p-6 col-span-5">
                        <small class="mb-4 font-medium">{{ $item->barangay->name }}</small>
                        <h3 class="text-balance text-xl font-bold text-neutral-900 lg:text-2xl dark:text-white"
                            aria-describedby="articleDescription">{{ $item->violation }}</h3>
                        <span
                            class="text-sm">{{ \Carbon\Carbon::parse($item->violation_date)->format('F d, Y') . ' ' . \Carbon\Carbon::parse($item->violation_time)->format('h:i A') }}
                        </span>

                        <div class="mt-5">
                            @switch($item->status)
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
                        </div>
                    </div>
                </article>
                @empty
                    <div class=" p-5 text-center">
                        No complaints found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
