<div class="ml-60">
    <h2 class="text-2xl font-bold mb-4">Land Applications</h2>

    <table class="min-w-full bg-white border border-gray-300 text-xs">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Applicant</th>
                <th class="border px-4 py-2">Location</th>
                <th class="border px-4 py-2">Land Measurement</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Appointment Schedule</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($landApplies as $apply)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $apply->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $apply->location }}</td>
                    <td class="border px-4 py-2 text-center">{{ $apply->landmeasurement }}</td>
                    <td class="border px-4 py-2 text-center">{{ number_format($apply->price, 2) }}</td>
                    <td class="border px-4 py-2 text-center">
                        {{ \Carbon\Carbon::parse($apply->appointment_schedule)->format('Y-m-d') ?? 'Not Set' }}
                    </td>

                    <td class="border px-4 py-2 text-center">
                        <span class="px-2 py-1 rounded text-white
                            {{ $apply->status == 'pending' ? 'bg-yellow-500' : ($apply->status == 'approved' ? 'bg-green-500' : 'bg-red-500') }}">
                            {{ ucfirst($apply->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
