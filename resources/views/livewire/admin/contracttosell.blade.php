<div>
    <div>
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="p-2  rounded-lg shadow-md grid grid-cols-3 ">
            @error('sellerName') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            @error('sellerDetails') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            @error('buyerName') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('buyerDetails') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('landLocation') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('landArea') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

            @error('phase') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('blockNo') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('lotNo') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror


            @error('area') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror



        </form>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md print-section">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">CONTRACT TO SELL</h2>
        <p class="text-gray-700 mb-2">KNOW ALL MEN BY THESE PRESENTS:</p>
        <p class="text-gray-700 mb-2">This Contract to Sell is made and executed by and between:</p>
        <div class="flex justify-between items-center mb-2">
            <input type="text" placeholder="Enter Seller's Name" class="text-gray-700 font-bold border-b-2 focus:outline-none focus:border-blue-500" wire:model="sellerName">
            <input type="text" placeholder="Enter Seller's Details" class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500 w-full ml-4" wire:model="sellerDetails">
        </div>
        <div class="flex justify-center items-center mb-2">
            <p class="text-gray-700">-and-</p>
        </div>
        <div class="flex justify-between items-center mb-2">
            <input type="text" placeholder="Enter Buyer's Name" class="text-gray-700 font-bold border-b-2 focus:outline-none focus:border-blue-500" wire:model="buyerName">
            <input type="text" placeholder="Enter Buyer's Details" class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500 w-full ml-4" wire:model="buyerDetails">
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">WITNESSETH: THAT-</h3>
        <div class="flex justify-between items-start mb-4">
            <p class="text-gray-700 font-bold">WHEREAS, </p>
            <p class="text-gray-700">
                the SELLER is the true and absolute owner of a parcel of land located at
                <input type="text" class="border-b border-gray-400 focus:outline-none" wire:model="landLocation" placeholder="">
                covered under Transfer Certificate of Title No. T-18570 Lot 2-B, Psd-12-004388 containing a total area of
                <input type="text" class="mt-2 border-b border-gray-400 focus:outline-none" wire:model="landArea" placeholder="">, more or less;
            </p>
        </div>
        <div class="flex justify-between items-start mb-4">
            <p class="text-gray-700 font-bold">WHEREAS, </p>
            <p class="text-gray-700">the SELLER has subdivided said parcel of land offered to the SECOND PARTY to buy a portion thereof and the latter is interested to buy the same;</p>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">NOW THEREFORE, for and in consideration of the foregoing premises, the parties have hereunto agreed as follows:</h3>
        <ol class="list-decimal list-inside text-gray-700 mb-4">
            <li>That the lot subject of this lot purchase agreement is described as follows:</li>
            <table class="w-full border-collapse text-center">
                <tbody>
                    <tr>
                        <th class="border p-2">Description: Lot</th>
                        <th class="border p-2">Phase</th>
                        <th class="border p-2">Block No.</th>
                        <th class="border p-2">Lot No.</th>
                        <th class="border p-2">Area</th>
                    </tr>
                    <tr>
                        <td class="border p-2"></td>
                        <td class="border p-2"><input type="text" placeholder="Phase" class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500" wire:model="phase"></td>
                        <td class="border p-2"><input type="text" placeholder="Block No." class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500" wire:model="blockNo"></td>
                        <td class="border p-2"><input type="text" placeholder="Lot No." class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500" wire:model="lotNo"></td>
                        <td class="border p-2"><input type="text" placeholder="Area" class="text-gray-700 border-b-2 focus:outline-none focus:border-blue-500" wire:model="area"></td>
                    </tr>
                </tbody>
            </table>
            <li>That the price per square is One Thousand Two hundred (P1,200.00) per square or the total sum of One Hundred Twenty Thousand Pesos Only (P120,000.00), Philippine Currency, payable in the following TERMS & CONDITIONS;</li>
            <li>The said amount shall be paid in STRAIGHT MONTHLY INSTALLMENT of (P2,000.00) payable upon the execution of this contract and within Sixty (60) Months, payable every 15th day of the month until fully paid;</li>
            <li>That should the BUYER fail to pay to the SELLER in three (3) consecutive months any unpaid monthly installments shall be charged an interest of Five (5%) PERCENT per month. Three (3) Month's delay shall be considered as overdue;</li>
            <li>That all payment shall be made directly to the office or collector of the SELLERS;</li>
            <li>That the ownership of the said parcel of land shall remain with the SELLER pending full payment of the total consideration, further, the BUYER is not allowed to lease or sell the parcel of land to any party unless the said consideration is fully paid. In the event that the said parcel of land is sold as a whole, the Seller shall return to the Buyer the full amount;</li>
            <li>Any violation thereof shall rescind this contract and forfeit all payment paid thereon in favor to the SELLER;</li>
        </ol>

        <section class="mt-8">
            <p class="mb-4">
                <span class="font-semibold">8.</span>
                That all necessary expenses for land survey, segregation and notarization of necessary documents shall be for the account of the SELLER. The SELLER shall be responsible to clear the area and deliver the same to the BUYER;
            </p>
            <p class="mb-4">
                <span class="font-semibold">9.</span>
                That the BUYER shall after full payment of the said lot by the SELLER deliver the title of the lot and the Deed of Absolute Sale to the latter. The BUYER shall be responsible for the transfer of title in his/her name and to pay the Capital Gains Tax, Documentary Stamp Tax and other related expenses for the transfer of title in his/her name. The SELLER shall assist the BUYER in the processing of the title;
            </p>
            <p class="mb-4">
                <span class="font-semibold">10.</span>
                That the BUYER shall join and maintain the association to be formed later and shall continue to maintain a good standing in the association;
            </p>
            <p class="mb-4">
                <span class="font-semibold">11.</span>
                That in case of suit, the venue shall be in the proper courts in Isulan, Sultan Kudarat only.
            </p>
        </section>

        <section class="mt-8">
            <p class="text-center font-semibold">IN WITNESS WHEREOF</p>
            <p class="text-center">the parties have hereunto set their hands, this ____ day of October 2021 in the Province of Isulan, Sultan Kudarat, Philippines.</p>
        </section>

        <section class="mt-12 flex justify-between">
            <div class="text-center">
                <p class="font-bold">Seller Name</p>
                <p class="text-sm">Seller</p>
            </div>
            <div class="text-center">
                <p class="font-bold">Buyer Name</p>
                <p class="text-sm">Buyer</p>
            </div>
        </section>

        <section class="mt-8">
            <p>Signed in the presence of:</p>
            <div class="mt-4 flex justify-between">
                <div class="text-center">
                    <p class="underline">_________________________</p>
                </div>
                <div class="text-center">
                    <p class="underline">_________________________</p>
                </div>
            </div>
        </section>

    <section class="mt-8">
        <h3 class="font-bold underline">ACKNOWLEDGMENT</h3>
        <p class="mt-4">
            Republic of the Philippines<br>
            In the Municipality of Isulan, Sultan Kudarat Ss.
        </p>
        <p class="mt-4">
            BEFORE ME, a Notary Public for and in the Municipality of Isulan, Sultan Kudarat, Philippines this ____ day of October 2021, Philippines, came and appeared the parties with their respective valid I.D. shown below their respective names, known to me to be the same persons who executed the foregoing instrument, and further acknowledged to me that the same is their free and voluntary act and deed.
        </p>
        <div class="mt-8 flex justify-between">
            <div class="text-center">
                <p class="font-bold">Seller Name</p>

                <p class="text-sm">Seller</p>
            </div>
            <div class="text-center">
                <p class="font-bold">Buyer Name</p>
                <p class="text-sm">Buyer</p>
            </div>
        </div>
        <div class="mt-8">
            <p class="font-semibold">NOTARY PUBLIC</p>
            <p class="text-sm">Doc No. ____<br>Page No. ____<br>Book No. ____<br>Series of 2021</p>
        </div>
    </section>
    </div>

    <div class="flex justify-center gap-2">
        <button class="bg-gray-500 hover:bg-gray-600 text-white w-64 p-2 h-12 mb-4 mt-4" wire:click="save">Save</button>
        <button class="bg-green-500 hover:bg-green-600  text-white w-64 h-12 p-2 mt-4" onclick="printContract()">Print</button>
    </div>
    <script>
        function printContract() {
            window.print();
        }
    </script>

</div>
