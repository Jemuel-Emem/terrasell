<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-bold mb-4">Payments</h2>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Receipt</th>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200">{{ $payment->name }}</td>
                    <td class="px-6 py-4 border-b border-gray-200">{{ $payment->amount }}</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <a href="{{ asset('storage/' . $payment->receipt_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View</a>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">{{ ucfirst($payment->status) }}</td>
                    <td class="px-6 py-4 border-b border-gray-200">{{ $payment->created_at->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        @if($payment->status === 'pending')
                            <button wire:click="approvePayment({{ $payment->id }})" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Approve</button>
                            <button wire:click="declinePayment({{ $payment->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Decline</button>
                        @else
                            <span class="text-gray-500">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>
