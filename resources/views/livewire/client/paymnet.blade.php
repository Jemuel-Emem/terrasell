<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Payment Information</h2>


    <form wire:submit.prevent="submitPayment">

        <div class="mb-4">
            <label for="amortization" class="block text-sm font-medium text-gray-700 mb-2">Select Amortization</label>
            <select wire:model="selectedAmortization" id="amortization"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
                <option value="">Choose an option</option>
                @foreach($amortizations as $amortization)
                    <option value="{{ $amortization->id }}">
                        {{ $amortization->buyersname }} - Phase: {{ $amortization->phase }}, Block: {{ $amortization->blockno }}, Lot: {{ $amortization->lotno }}
                    </option>
                @endforeach
            </select>
            @error('selectedAmortization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input type="text" id="name" wire:model="name" placeholder="Enter your name"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount to Pay</label>
            <input type="number" id="amount" wire:model="amount" placeholder="Enter amount to pay"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label for="mop" class="block text-sm font-medium text-gray-700 mb-2">Mode of Payment</label>
            <select id="mop" wire:model="mop" onchange="toggleReceiptField()"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
                <option value="">Select Mode of Payment</option>
                <option value="gcash">Gcash</option>
                <option value="walkin">Walk In</option>
            </select>
            @error('mop') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Receipt Upload Field (conditionally displayed) -->
        <div class="mb-4" id="receipt-upload" style="display: none;">
            <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Upload Receipt</label>
            <input type="file" id="receipt" wire:model="receipt"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('receipt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300 transition duration-150 ease-in-out w-full">
                Submit Payment
            </button>
        </div>
    </form>


    <script>
        function toggleReceiptField() {
            const mopSelect = document.getElementById('mop');
            const receiptUpload = document.getElementById('receipt-upload');
            if (mopSelect.value === 'gcash') {
                receiptUpload.style.display = 'block';
            } else {
                receiptUpload.style.display = 'none';
            }
        }
    </script>

</div>

