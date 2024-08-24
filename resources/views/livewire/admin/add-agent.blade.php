
<div>
 {{-- <x-alert class="bg-green-700 text-green-100 p-4" /> --}}

   <div class="flex justify-end">

    <x-button label="Add Agent" emerald icon="plus" wire:click="$set('add_modal', true)" />
   </div>

    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                     Name
                     </th>

                    <th scope="col" class="px-6 py-3">
                    Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Address
                     </th>
                     <th scope="col" class="px-6 py-3">
                     Username
                     </th>


                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
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
        <div>
          {{ $agents->links() }}
        </div>
    </div>



    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Agent">
            <div class="space-y-3">

                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Number" wire:model="number" placeholder="" />
                <x-input label="Address" placeholder="" wire:model="address" />

                <x-input label="Username" placeholder="" wire:model="username" />

                <x-input label="Password" placeholder="" wire:model="password" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  />
                    <x-button  label="Add Agent" wire:click="addagent" spinner="addagent" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    <x-modal wire:model.defer="edit_modal">
        <x-card title="Add Agent">
            <div class="space-y-3">

                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Number" wire:model="number" placeholder="" />
                <x-input label="Address" placeholder="" wire:model="address" />

                <x-input label="Username" placeholder="" wire:model="username" />

                <x-input label="Password" placeholder="" wire:model="password" />
                <x-select
                label="Account type"
                placeholder="Select account type"
                :options="['Admin', 'Agent']"
                wire:model.defer="accounttype"
                />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  />
                    <x-button  label="Update Agent" wire:click="updateagent" spinner="" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

