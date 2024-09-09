<div>
    {{-- <x-alert class="bg-green-700 text-green-100 p-4" /> --}}
    <div class="flex justify-end">
        <x-button label="Add Monthly Amortization" emerald icon="plus" wire:click="$set('add_modal', true)" />
    </div>

    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Buyer's Name</th>
                    <th scope="col" class="px-6 py-3">Buyer's Details</th>
                    <th scope="col" class="px-6 py-3">Phase</th>
                    <th scope="col" class="px-6 py-3">Block No</th>
                    <th scope="col" class="px-6 py-3">Lot No</th>
                    <th scope="col" class="px-6 py-3">Area</th>
                    <th scope="col" class="px-6 py-3">Monthly Payment</th>
                    <th scope="col" class="px-6 py-3">Total Payment</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buyers as $buyer)
                    <tr>
                        <td class="px-6 py-4">{{ $buyer->buyersname }}</td>
                        <td class="px-6 py-4">{{ $buyer->buyersdetails }}</td>
                        <td class="px-6 py-4">{{ $buyer->phase }}</td>
                        <td class="px-6 py-4">{{ $buyer->blockno }}</td>
                        <td class="px-6 py-4">{{ $buyer->lotno }}</td>
                        <td class="px-6 py-4">{{ $buyer->area }}</td>
                        <td class="px-6 py-4">{{ $buyer->monthlypayment }}</td>
                        <td class="px-6 py-4">{{ $buyer->totalpayment }}</td>
                        <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="edit" icon="pencil-alt"
                                wire:click="edit({{ $buyer->id }})" positive />
                            <x-button class="w-16 h-6" label="delete" icon="trash"
                                x-on:confirm="{
                                    title: 'Are you sure?',
                                    icon: 'warning',
                                    method: 'delete',
                                    params: {{ $buyer->id }}
                                }" negative />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $buyers->links() }}
        </div>
    </div>

    {{-- Add Buyer Modal --}}
    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Buyer">
            <div class="space-y-3">
                <x-input label="Buyer's Name" placeholder="" wire:model="buyersname" />
                <x-input label="Buyer's Details" wire:model="buyersdetails" placeholder="" />
                <x-input label="Phase" placeholder="" wire:model="phase" />
                <x-input label="Block No" placeholder="" wire:model="blockno" />
                <x-input label="Lot No" placeholder="" wire:model="lotno" />
                <x-input label="Area" placeholder="" wire:model="area" />
                <x-input label="Monthly Payment" placeholder="" wire:model="monthlypayment" />
                <x-input label="Total Payment" placeholder="" wire:model="totalpayment" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Add Buyer" wire:click="addBuyer" spinner="addBuyer" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- Edit Buyer Modal --}}
    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Buyer">
            <div class="space-y-3">
                <x-input label="Buyer's Name" placeholder="" wire:model="buyersname" />
                <x-input label="Buyer's Details" wire:model="buyersdetails" placeholder="" />
                <x-input label="Phase" placeholder="" wire:model="phase" />
                <x-input label="Block No" placeholder="" wire:model="blockno" />
                <x-input label="Lot No" placeholder="" wire:model="lotno" />
                <x-input label="Area" placeholder="" wire:model="area" />
                <x-input label="Monthly Payment" placeholder="" wire:model="monthlypayment" />
                <x-input label="Total Payment" placeholder="" wire:model="totalpayment" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Update Buyer" wire:click="updateBuyer" spinner="updateBuyer" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
