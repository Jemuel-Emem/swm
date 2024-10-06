<div>
    <div class="flex justify-end items-center space-x-3">
        <div class="w-96">
            <x-input placeholder="Search Violations..." wire:model.live="search" />
        </div>
        <x-button label="New Violation" icon="plus" positive class="font-semibold" wire:click="$set('add_modal', true)" />
    </div>
    <div class="flex flex-col mt-5">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden border">
                    <table class="min-w-full divide-y divide-neutral-200/70">
                        <thead>
                            <tr class="text-neutral-800">

                                <th class="px-5 py-3 text-xs font-medium text-left uppercase">Violation Name</th>
                                <th class="px-5 py-3 text-xs font-medium text-right uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200/70">
                            @forelse ($violations as $violation)
                                <tr class="text-neutral-600 bg-neutral-50">

                                    <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{ $violation->name }}</td>
                                    <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <x-button label="Edit" positive icon="pencil-alt"
                                            wire:click="edit({{ $violation->id }})" class="font-semibold" />
                                        <x-button label="Delete" negative icon="trash"
                                            class="font-semibold text-red-500"
                                            x-on:confirm="{
                                                title: 'Are you sure?',
                                                icon: 'error',
                                                method: 'delete',
                                                params: {{ $violation->id }}
                                            }" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-4 text-sm font-medium text-center whitespace-nowrap">
                                        <span>No violations found...</span>
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
        <x-card title="New Violation">
            <div>
                <x-input label="Violation Name" class="h-12" wire:model="name" />

            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button positive label="Submit" wire:click="submitRecord" spinner="submitRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    <x-modal wire:model.defer="edit_modal" align="center">
        <x-card title="Edit Violation">
            <div>
                <x-input label="Violation Name" class="h-12" wire:model="name" />

            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button positive label="Update" wire:click="updateRecord" spinner="updateRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
