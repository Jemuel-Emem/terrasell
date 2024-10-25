<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Property Applications</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 text-center">Applicant Name</th>
                <th class="py-2 px-4 text-center">Location</th>
                <th class="py-2 px-4 text-center">Land Measurement</th>
                <th class="py-2 px-4 text-center">Price</th>
                <th class="py-2 px-4 text-center">Booking Schedule</th>
                <th class="py-2 px-4 text-center">Status</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applications as $application)
                <tr>
                    <td class="py-2 px-4 text-center">{{ $application->name }}</td>
                    <td class="py-2 px-4 text-center">{{ $application->location }}</td>
                    <td class="py-2 px-4 text-center">{{ $application->landmeasurement }}</td>
                    <td class="py-2 px-4 text-center">{{ $application->price }}</td>
                    <td class="py-2 px-4 text-center">{{ \Carbon\Carbon::parse($application->appointment_schedule)->format('Y-m-d') }}</td>
                    <td class="py-2 px-4 text-center">
                        {{ $application->status ?? 'Pending' }}
                    </td>
                    <td class="py-2 px-4 text-center">
                        @if ($application->status === 'approved')
                            <span class="text-green-500 font-semibold">Approved</span>
                        @elseif ($application->status === 'declined')
                            <span class="text-red-500 font-semibold">Declined</span>
                        @else
                            <x-button class="bg-green-500 text-white" wire:click="approve({{ $application->id }})">Approve</x-button>
                            <x-button class="bg-red-500 text-white" wire:click="decline({{ $application->id }})">Decline</x-button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-2 px-4 text-center">No applications found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
