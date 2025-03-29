<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Payment History</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">Date</th>
                <th class="border p-2">Amount</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr class="text-center">
                    <td class="border p-2">{{ $payment->created_at->format('M d, Y') }}</td>
                    <td class="border p-2">₱{{ number_format($payment->amount, 2) }}</td>
                    <td class="border p-2">
                        <span class="px-2 py-1 rounded {{ $payment->status === 'Completed' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                            {{ $payment->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center text-gray-500">No payment history found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
