<div>
    <div class="mt-4 p-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input wire:model="search" placeholder="Enter  address, or price" label="Search address or price "></x-input>
            </div>
            <div class="mt-6">
                <x-button class="w-64 bg-green-700 text-white hover:bg-green-800" wire:click="find">Search</x-button>
            </div>
        </div>

        <div class="grid grid-cols-4 mt-4 gap-4">
            @forelse ($land as $lands)
                <x-card>
                    <div>
                        <img src="{{ asset(Storage::url($lands->photo)) }}" alt="Land Photo" class="w-80 h-32 rounded">
                        <div class="flex flex-col mt-2">
                            <label class="text-gray-500">Actual video</label>
                            <video width="320" height="100" controls>
                                <source src="{{ Storage::url($lands->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="flex gap-4 mt-2">
                            <label class="text-gray-500">Address:</label>
                            {{ $lands->address }}
                        </div>
                        <div class="flex gap-4 mt-2">
                            <label class="text-gray-500">Location:</label>
                            <a href="{{ $lands->location }}" class="text-green-500">View Map</a>
                        </div>
                        <div class="flex gap-4 mt-2">
                            <label class="text-gray-500">Land Measurement:</label>
                            {{ $lands->landmeasurement }}
                        </div>
                        <div class="flex gap-4 mt-2">
                            <label class="text-gray-500">Price:</label>
                            {{ $lands->price }}
                        </div>
                        <footer class="mt-4 text-center">
                            <x-button class="bg-green-500 text-white" wire:click="applyNow({{ $lands->id }})">Apply Now</x-button>
                        </footer>
                    </div>
                </x-card>
            @empty
                <p class="text-center col-span-4">No lands found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $land->links() }}
        </div>

        <x-modal wire:model.defer="apply_modal">
            <x-card title="Apply for Land">
                <form wire:submit.prevent="submitApplication">
                    <div class="space-y-4">
                        <x-input label="Location" value="{{ $selected_land['location'] ?? 'N/A' }}" readonly />
                        <x-input label="Address" value="{{ $selected_land['address'] ?? 'N/A' }}" readonly />
                        <x-input label="Land Measurement" value="{{ $selected_land['landmeasurement'] ?? 'N/A' }}" readonly />
                        <x-input label="Price" value="{{ $selected_land['price'] ?? 'N/A' }}" readonly />
                        <x-input label="Your Name" value="{{ Auth::user()->name ?? 'N/A' }}" readonly />
                        <x-input label="Phone Number" value="{{ Auth::user()->number ?? 'N/A' }}" readonly />
                        <x-input type="date" label="Select Booking Date" wire:model.defer="booking_date" />
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-end space-x-4">
                            <x-button flat label="Cancel" wire:click="$set('apply_modal', false)" />
                            <x-button class="bg-green-500 text-white" wire:click="submitApplication">
                                Book Now
                            </x-button>
                        </div>
                    </x-slot>
                </form>
            </x-card>
        </x-modal>
    </div>
</div>
