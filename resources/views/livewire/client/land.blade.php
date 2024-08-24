<div>
    <div class="mt-4 p-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input class="" wire:model="search" placeholder="Enter location name" label="Search Location"></x-input>
            </div>
            <div class="mt-6">
                <x-button class="w-64 bg-green-700 text-white hover:bg-green-800" wire:click="find">Search</x-button>
            </div>
        </div>

        <div class="grid grid-cols-4 mt-4 gap-4">
            @forelse ($land as $lands)
            <x-card cla>
                <div class="">
                    <img src="{{ asset(Storage::url($lands->photo)) }}" alt="Valid ID" class="w-80 h-32 rounded">

                    <div class="flex flex-col">
                        <div>
                            <label for="" class="text-gray-500">Actual video</label>
                        </div>
                        <video width="320" height="100" controls>
                            <source src="{{ Storage::url($lands->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="flex gap-4">
                        <label for="" class="text-gray-500">Address:</label>
                        {{ $lands->address }}
                    </div>
                    <div class="flex gap-4">
                        <label for="" class="text-gray-500">Location:</label>
                        {{ $lands->location }}
                    </div>
                    <div class="flex gap-4">
                        <label for="" class="text-gray-500">Land Measurement:</label>
                        {{ $lands->landmeasurement }}
                    </div>
                    <div class="flex gap-4">
                        <label for="" class="text-gray-500">Price:</label>
                        {{ $lands->price }}
                    </div>
                    <footer class="mt-4 text-center">
                        <x-button class="bg-green-500 text-white">Apply Now</x-button>
                    </footer>
                </div>
            </x-card>
            @empty
           
            @endforelse

            <div class="mt-4">
                <span>{{ $land->links() }}</span>
            </div>
        </div>
    </div>
</div>
