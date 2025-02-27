<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Contract To Sell List</h1>
        <x-button label="Print" icon="printer" positive onclick="printContractsTable()" />
    </div>

    @if($contracts->isEmpty())
        <p class="text-gray-500">No contracts available.</p>
    @else
        <table id="contractsTable" class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-2 text-left">Buyer Name</th>
                    <th class="p-2 text-left">Seller Name</th>
                    <th class="p-2 text-left">Land Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    <tr>
                        <td class="p-2 border-b">{{ $contract->BuyersName }}</td>
                        <td class="p-2 border-b">{{ $contract->SellersName }}</td>
                        <td class="p-2 border-b">{{ $contract->LandLocation }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    function printContractsTable() {
        let table = document.getElementById("contractsTable").cloneNode(true);

        let newWindow = window.open("", "", "width=800,height=600");
        newWindow.document.write(`
            <html>
                <head>
                    <title>Print Contracts</title>
                    <style>
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h2>Contract To Sell List</h2>
                    ${table.outerHTML}
                </body>
            </html>
        `);
        newWindow.document.close();
        newWindow.print();
    }
</script>
