<div>
    <div class="flex justify-end gap-2">
        <x-button label="Add Landowner Details" emerald icon="plus" wire:click="$set('add_modal', true)" />
        <x-button label="Print" icon="printer" positive onclick="printLandownerTable()" />
    </div>

    <div class="relative overflow-x-auto mt-4">
        <table id="landownerTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">First Name</th>
                    <th class="px-6 py-3">Last Name</th>
                    <th class="px-6 py-3">Number</th>
                    <th class="px-6 py-3">Address</th>
                    <th class="px-6 py-3">Location</th>
                    <th class="px-6 py-3">Price</th>
                    <th class="px-6 py-3">Land Measurements</th>
                    <th class="px-6 py-3">Photo</th>
                    <th class="px-6 py-3 text-center">Action</th> {{-- UI only, not in print --}}
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
                            <img src="{{ asset(Storage::url($q->photo)) }}" alt="Land Photo" class="w-20 h-16 rounded">
                        </td>
                        <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                            <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $q->id }})" positive />
                            <x-button class="w-16 h-6" label="delete" icon="trash"
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
                        <td colspan="9" class="text-center py-4">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>{{ $landowner->links() }}</div>
    </div>
</div>

<script>
    function printLandownerTable() {
        let table = document.getElementById("landownerTable").cloneNode(true);

        // Remove the last column (Action) from both the header and rows
        table.querySelectorAll("tr").forEach(row => {
            row.removeChild(row.lastElementChild);
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
                    ${table.outerHTML}
                </body>
            </html>
        `);
        newWindow.document.close();
        newWindow.print();
    }
</script>
