<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Payment Information</h2>

    <!-- Form Start -->
    <form wire:submit.prevent="submitPayment">
        <!-- Amortization Select Field -->
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

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input type="text" id="name" wire:model="name" placeholder="Enter your name"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Amount to Pay Field -->
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount to Pay</label>
            <input type="number" id="amount" wire:model="amount" placeholder="Enter amount to pay"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Receipt Upload Field -->
        <div class="mb-4">
            <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Upload Receipt</label>
            <input type="file" id="receipt" wire:model="receipt"
                class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            @error('receipt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out w-full">
                Submit Payment
            </button>
        </div>
    </form>
    <!-- Form End -->
</div>
