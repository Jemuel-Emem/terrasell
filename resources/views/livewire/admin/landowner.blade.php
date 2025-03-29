<div>
    {{-- <x-alert class="bg-green-700 text-green-100 p-4" /> --}}

    <div class="flex justify-end gap-2">
        <x-button label="Add Landowner Details" emerald icon="plus" wire:click="$set('add_modal', true)" />
        <x-button label="Print" icon="printer" positive onclick="printLandownerTable()" />
    </div>

    <div class="relative overflow-x-auto mt-4">
        <table id="landownerTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">First Name</th>
                    <th scope="col" class="px-6 py-3">Last Name</th>
                    <th scope="col" class="px-6 py-3">Number</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Location</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Land Measurements</th>
                    <th scope="col" class="px-6 py-3">Photo</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($landowner as $q)
                    <tr>
                        <td class="px-6 py-4">{{ $q->firstname }}</td>
                        <td class="px-6 py-4">{{ $q->lastname }}</td>
                        <td class="px-6 py-4">{{ $q->number }}</td>
                        <td class="px-6 py-4">{{ $q->address }}</td>
                        <td class="px-6 py-4">{{ $q->location }}</td>
                        <td class="px-6 py-4">{{ $q->price }}</td>
                        <td class="px-6 py-4">{{ $q->landmeasurement }}</td>
                        <td class="px-6 py-4">
                            <img src="{{ asset(Storage::url($q->photo)) }}" alt="Valid ID" class="w-20 h-16 rounded">
                        </td>
                        <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $q->id }})" positive />
                            <x-button class="w-16 h-6" label="delete" icon="pencil-alt"
                                x-on:confirm="{
                                    title: 'Sure Delete?',
                                    icon: 'warning',
                                    method: 'delete',
                                    params: {{ $q->id }}
                                }" negative />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>{{ $landowner->links() }}</div>
    </div>

    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Landowner">
            <div class="space-y-3">
                <x-input label="First Name" placeholder="" wire:model="firstname" />
                <x-input label="Last Name" wire:model="lastname" placeholder="" />
                <x-input label="Number" placeholder="" wire:model="number" />
                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Location" placeholder="" wire:model="location" />
                <x-input label="Price" placeholder="" wire:model="price" />
                <x-input label="Land Measurements" placeholder="" wire:model="land_measurements" />
                @if ($photoPreview)
                <div>
                    <img src="{{ $photoPreview }}" alt="Photo Preview" class="w-20 h-16 rounded">
                </div>
            @endif
                <x-input label="Photo" placeholder="" wire:model="photo" type="file" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Add Landowner" wire:click="addlandowner" spinner="" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal wire:model.defer="edit_modal">
        <x-card title="Add Landowner">
            <div class="space-y-3">
                <x-input label="First Name" placeholder="" wire:model="firstname" />
                <x-input label="Last Name" wire:model="lastname" placeholder="" />
                <x-input label="Number" placeholder="" wire:model="number" />
                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Location" placeholder="" wire:model="location" />
                <x-input label="Price" placeholder="" wire:model="price" />
                <x-input label="Land Measurements" placeholder="" wire:model="land_measurements" />
                @if ($photoPreview)
                <div>
                    <img src="{{ $photoPreview }}" alt="Photo Preview" class="w-20 h-16 rounded">
                </div>
            @endif
                <x-input label="Photo" placeholder="" wire:model="photo" type="file" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button label="Update Landowner" wire:click="updateLandowner" spinner="" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

<script>
    function printLandownerTable() {
        let table = document.getElementById("landownerTable");

        if (!table) {
            alert("Error: Table not found.");
            return;
        }

        let clonedTable = table.cloneNode(true);

        // Remove the last column (Action) from both the header and rows
        clonedTable.querySelectorAll("tr").forEach(row => {
            if (row.lastElementChild) {
                row.removeChild(row.lastElementChild);
            }
        });

        // Ensure image paths are absolute for printing
        clonedTable.querySelectorAll("img").forEach(img => {
            img.src = img.src; // Forces absolute path for printing
        });

        let newWindow = window.open("", "", "width=800,height=600");
        newWindow.document.write(`
            <html>
                <head>
                    <title>Print Landowner Details</title>
                    <style>
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        img { width: 60px; height: 40px; object-fit: cover; border-radius: 5px; }
                    </style>
                </head>
                <body>
                    <h2>Landowner Details</h2>
                    ${clonedTable.outerHTML}
                </body>
            </html>
        `);
        newWindow.document.close();
        newWindow.print();
    }
</script>

