<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Application Status</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-gray-50">
                <tr>

                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Land Measurement
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($applications as $application)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->location }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->landmeasurement }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->price }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $application->status === 'Approved' ? 'bg-green-100 text-green-800' : ($application->status === 'Declined' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $application->status ?? 'Pending' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center text-gray-500">No applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
