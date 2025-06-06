<div>
    {{-- Add Monthly Amortization Button & Print Button --}}
    <div class="flex justify-between items-center mb-4">
        <x-button label="Add Monthly Amortization" emerald icon="plus" wire:click="$set('add_modal', true)" />
        <x-button label="Print" icon="printer" positive onclick="printAmortizationTable()" />
    </div>

    {{-- Data Table --}}
    <div class="relative overflow-x-auto mt-4">
        <table id="amortizationTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        <td class="px-6 py-4">{{ $buyer->totalpayment - $buyer->totalfee }}</td>
                        <td class="py-2 px-4 text-center {{ $buyer->totalfee >= $buyer->totalpayment ? 'text-green-500' : 'text-red-500' }}">
                            {{ $buyer->totalfee >= $buyer->totalpayment ? 'Paid' : 'Not Paid' }}
                        </td>
                        <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="View" icon="pencil-alt" wire:click="edit({{ $buyer->id }})" positive />
                            <x-button class="w-16 h-6" label="Delete" icon="trash"
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
                        <td colspan="12" class="text-center py-4">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
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
                <x-input label="Total Cost" placeholder="" id="totalpayment" wire:model="totalpayment" />
                <div>
                    <label for="paymentDuration" class="block text-sm font-medium text-gray-700">Payment Duration</label>
                    <select id="paymentDuration" wire:model="paymentDuration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="calculateMonthlyPayment()">
                        <option value="">Select Payment Duration</option>
                        <option value="2">2 Years</option>
                        <option value="3">3 Years</option>
                        <option value="5">5 Years</option>
                    </select>
                </div>
                <x-input label="Monthly Payment" placeholder="" wire:model="monthlypayment" id="monthlypayment" readonly />
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

<script>

function calculateMonthlyPayment() {
        let totalPayment = parseFloat(document.getElementById('totalpayment').value) || 0;
        let duration = parseInt(document.getElementById('paymentDuration').value) || 0;
        let months = duration * 12; // Convert years to months
        let monthlyPayment = months > 0 ? (totalPayment / months).toFixed(2) : 0;

        document.getElementById('monthlypayment').value = monthlyPayment;
        @this.set('monthlypayment', monthlyPayment); // Update Livewire property
    }
    function printAmortizationTable() {
        let table = document.getElementById("amortizationTable").cloneNode(true);

        let newWindow = window.open("", "", "width=800,height=600");
        newWindow.document.write(`
            <html>
                <head>
                    <title>Print Monthly Amortization</title>
                    <style>
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h2>Monthly Amortization List</h2>
                    ${table.outerHTML}
                </body>
            </html>
        `);
        newWindow.document.close();
        newWindow.print();
    }
</script>
