<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Monthly Amortization</h2>

        @if ($amortizations->isEmpty())
            <p class="text-center text-gray-600">No amortization records found.</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border">Area</th>
                        <th class="py-2 px-4 border">Due Date</th>
                        <th class="py-2 px-4 border">Monthly Payment Fee</th>
                        <th class="py-2 px-4 border">Total Fee</th>
                        <th class="py-2 px-4 border">Balance</th>
                        {{-- <th class="py-2 px-4 border">Balance</th> --}}
                        <th class="py-2 px-4 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($amortizations as $amortization)
                        <tr>
                            <td class="py-2 px-4 border text-center">{{ $amortization->area }}</td>
                            <td class="py-2 px-4 border text-center"> Every {{ \Carbon\Carbon::parse($amortization->due_date)->format('jS') }} of the month
                            </td>
                            <td class="py-2 px-4 border text-center">{{ $amortization->monthlypayment }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amortization->totalfee }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amortization->totalpayment }}</td>
                            {{-- <td class="py-2 px-4 border text-center">{{ $amortization->totalpayment - $amortization->totalfee }}</td> --}}
                             @if ($amortization->totalfee>=$amortization->totalpayment)
                             <td class="py-2 px-4 border text-center text-green-500">Paid</td>

                             @else
                             <td class="py-2 px-4 border text-center text-red-500">Not Paid</td>
                             @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
