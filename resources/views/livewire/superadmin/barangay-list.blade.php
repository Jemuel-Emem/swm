<div>
    <div class="flex justify-end items-center space-x-3">
        <div class="w-96">
            <x-input placeholder="Search..." wire:model.live="search" />
        </div>
        <x-button label="New Barangay" icon="plus" positive class="font-semibold" wire:click="$set('add_modal', true)" />
    </div>
    <div class="flex flex-col mt-5">
        <div class="overflow-x-auto">
            <div class="inline-block  min-w-full">
                <div class="overflow-hidden border">
                    <table class="min-w-full divide-y divide-neutral-200/70">
                        <thead>
                            <tr class="text-neutral-800">
                                <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name</th>

                                <th class="px-5 py-3 text-xs font-medium text-right uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200/70">
                            @forelse ($barangays as $item)
                                <tr class="text-neutral-600 bg-neutral-50">
                                    <td class="px-5 py-4 text-sm uppercase font-medium whitespace-nowrap">
                                        {{ $item->name }}</td>

                                    <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <x-button label="Edit" positive icon="pencil-alt"
                                            wire:click="edit({{ $item->id }})" class="font-semibold" />
                                        <x-button label="Delete" negative icon="trash"
                                            class="font-semibold text-red-500"
                                            x-on:confirm="{
                                                title: 'Sure Delete?',
                                                icon: 'error',
                                                method: 'delete',
                                                params: {{ $item->id }}
                                            }" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"
                                        class="px-5 py-4 text-sm font-medium text-center whitespace-nowrap">
                                        <span>No barangay found...</span>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <x-modal wire:model.defer="add_modal" align="center">
        <x-card title="New Barangay">
            <div>
                <div>
                    <x-input label="Name" class="h-12" wire:model="name" />
                </div>
                <div class="mt-5">
                    <span>Set the Location</span>
                </div>
                <div class=" border-t pt-5 grid grid-cols-2 gap-3">

                    <x-input label="Longitude" type="number" class="h-12" wire:model="longitude" />
                    <x-input label="Latitude" type="number" class="h-12" wire:model="latitude" />
                </div>
                <div class="mt-5">
                    <span>Assign an Account</span>
                </div>
                <div class=" border-t pt-5 grid grid-cols-2 gap-3">
                    <x-input label="Email" type="email" class="h-12" wire:model="email" />
                    <x-input label="Password" type="password" class="h-12" wire:model="password" />
                    <x-input label="Confirm Password" type="password" class="h-12" wire:model="confirm_password" />
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button positive label="Submit Record" wire:click="submitRecord" spinner="submitRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
    <x-modal wire:model.defer="edit_modal" align="center">
        <x-card title="Update Barangay">
            <div>
                <div>
                    <x-input label="Name" class="h-12" wire:model="name" />
                </div>
                <div class="mt-5">
                    <span>Set the Location</span>
                </div>
                <div class=" border-t pt-5 grid grid-cols-2 gap-3">

                    <x-input label="Longitude" type="number" class="h-12" wire:model="longitude" />
                    <x-input label="Latitude" type="number" class="h-12" wire:model="latitude" />
                </div>

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button positive label="Update Record" wire:click="updateRecord" spinner="updateRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
