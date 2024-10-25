<div>
    {{-- Add Monthly Amortization Button --}}
    <div class="flex justify-end">
        <x-button label="Add Monthly Amortization" emerald icon="plus" wire:click="$set('add_modal', true)" />
    </div>

    {{-- Data Table --}}
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
                    <th scope="col" class="px-6 py-3">Total Fee</th>
                    <th scope="col" class="px-6 py-3">Total Cost</th>
                    <th scope="col" class="px-6 py-3">Balance</th>
                    <th scope="col" class="px-6 py-3">Status</th>

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
                        <td class="px-6 py-4">{{ $buyer->totalfee }}</td>
                        <td class="px-6 py-4">{{ $buyer->totalpayment }}</td>
                        <td class="px-6 py-4">{{ $buyer->totalpayment-  $buyer->totalfee }}</td>
                        @if ($buyer->totalfee>=$buyer->totalpayment)

                        <td class="py-2 px-4  text-center text-green-500">Paid</td>

                        @else
                        <td class="py-2 px-4  text-center text-red-500">Not Paid</td>
                        @endif

                        <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="View" icon="pencil-alt" wire:click="edit({{ $buyer->id }})" positive />
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
        <x-card title="Add Ammortization">
            <div class="space-y-3">
                <label for="buyersname">Buyer's Name</label>
                <select id="buyersname" wire:model="buyersname" class="form-select">
                    <option value="">Select a buyer</option>
                    @foreach($buyerNames as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

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
                    <x-button label="Add Data" wire:click="addBuyer" spinner="addBuyer" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- Edit Buyer Modal --}}
    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Buyer">
            <div class="space-y-3">
                <label for="edit_buyersname" class="block text-sm font-medium text-gray-700">Buyer's Name</label>
                <select id="edit_buyersname" wire:model="buyersname" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="" disabled>Select a buyer</option>
                    @foreach($buyerNames as $id => $name)
                        <option value="{{ $name}}">{{ $name }}</option>
                    @endforeach
                </select>


                <x-input label="Buyer's Details" wire:model="buyersdetails" placeholder="" />
                <x-input label="Phase" placeholder="" wire:model="phase" />
                <x-input label="Block No" placeholder="" wire:model="blockno" />
                <x-input label="Lot No" placeholder="" wire:model="lotno" />
                <x-input label="Area" placeholder="" wire:model="area" />
                <x-input label="Monthly Payment" placeholder="" wire:model="monthlypayment" />
                <x-input label="Total Payment" placeholder="" wire:model="totalfee" />
                <x-input label="Total Cost" placeholder="" wire:model="totalpayment" />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Update " wire:click="updateBuyer" spinner="updateBuyer" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
