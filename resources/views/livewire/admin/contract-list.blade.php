<div>


    <h1 class="text-2xl font-bold mb-4">Contract To Sell List</h1>

    @if($contracts->isEmpty())
        <p class="text-gray-500">No contracts available.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-2 text-left">Contract ID</th>
                    <th class="p-2 text-left">Buyer Name</th>
                    <th class="p-2 text-left">Seller Name</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    <tr>
                        <td class="p-2 border-b">{{ $contract->id }}</td>
                        <td class="p-2 border-b">{{ $contract->BuyersName }}</td>
                        <td class="p-2 border-b">{{ $contract->SellersName }}</td>

                            <td class="">
                                <x-button class="w-16 h-6" label="View" icon="pencil-alt" wire:click="viewcontracttosell" positive />
                                    <x-button class="w-16 h-6" label="delete" icon="pencil-alt"
                                    x-on:confirm="{
                                        title: 'Sure Delete?',
                                        icon: 'warning',
                                        method: 'delete',
                                        params:
                                    }" negative />
                            </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif



</div>
