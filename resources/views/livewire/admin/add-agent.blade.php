<div>
    <div class="flex justify-end gap-2">
        <x-button label="Add Agent" emerald icon="plus" wire:click="$set('add_modal', true)" />
        <x-button label="Print" icon="printer" positive onclick="printAgentTable()" />
    </div>

    <div class="relative overflow-x-auto mt-4">
        <table id="agentTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Number</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th> {{-- Kept for UI but removed in print --}}
                </tr>
            </thead>
            <tbody>
                @forelse($agents as $q)
                    <tr>
                        <td class="px-6 py-4">{{ $q->name }}</td>
                        <td class="px-6 py-4">{{ $q->number }}</td>
                        <td class="px-6 py-4">{{ $q->address }}</td>
                        <td class="px-6 py-4">{{ $q->email }}</td>
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
                        <td colspan="5" class="text-center py-4">No data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $agents->links() }}
        </div>
    </div>
</div>

<script>
    function printAgentTable() {
        let table = document.getElementById("agentTable").cloneNode(true);

        // Remove the last column (Action) from both the header and rows
        table.querySelectorAll("tr").forEach(row => {
            row.removeChild(row.lastElementChild);
        });

        let newWindow = window.open("", "", "width=800,height=600");
        newWindow.document.write(`
            <html>
                <head>
                    <title>Print Agents</title>
                    <style>
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h2>Agent List</h2>
                    ${table.outerHTML}
                </body>
            </html>
        `);
        newWindow.document.close();
        newWindow.print();
    }
</script>
