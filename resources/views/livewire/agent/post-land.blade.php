
<div class="ml-60">
    {{-- <x-alert class="bg-green-700 text-green-100 p-4" /> --}}

      <div class="flex justify-end">

       <x-button label="Add Land" emerald icon="plus" wire:click="$set('add_modal', true)" />
      </div>

       <div class="relative overflow-x-auto mt-4">
           <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
               <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                   <tr>
                       <th scope="col" class="px-6 py-3">
                        Address
                        </th>
                       <th scope="col" class="px-6 py-3">
                       Location
                       </th>
                       <th scope="col" class="px-6 py-3">
                       Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                       Land Measurement
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                         Photo
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Video
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                       <th scope="col" class="px-6 py-3 text-center">
                           Action
                       </th>
                   </tr>
               </thead>
               <tbody>
                    @forelse($landowner as $q)
                   <tr>

                       <td class="px-6 py-4">{{ $q->address }}</td>
                       <td class="px-6 py-4">{{ $q->location }}</td>
                       <td class="px-6 py-4">{{ $q->price }}</td>
                       <td class="px-6 py-4">{{ $q->landmeasurement }}</td>
                       <td class="px-6 py-4">{{ $q->price }}</td>
                       <td class="px-6 py-4"> <img src="{{ asset(Storage::url($q->photo)) }}" alt="Valid ID" class="w-20 h-16 rounded"></td>
                       <td class="px-6 py-4">  <video width="200" height="100" controls>
                        <source src="{{ Storage::url($q->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video></td>
                    <td class="px-6 py-4">{{ $q->category }}</td>

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
             {{ $landowner->links() }}
           </div>
       </div>



       <x-modal wire:model.defer="add_modal">
           <x-card title="Post Land">
               <div class="space-y-3">

                   <x-input label="Address" placeholder="" wire:model="address" />
                   <x-input label="Location" wire:model="location" placeholder="" />
                   <x-input label="Price" placeholder="" wire:model="price" />
                   <x-input label="Land Measurement" placeholder="" wire:model="landmeasurement" />
                   <x-select
                   label="Select Category"
                   placeholder="Select one status"
                   :options="['','Residential', 'Commercial', 'Agriculture']"
                   wire:model.defer="category"
               />
                   <x-input label="Photo" placeholder="" wire:model="photo" type="file"/>
                   <x-input label="Video" placeholder="" wire:model="video" type="file"/>



               </div>

               <x-slot name="footer">
                   <div class="flex justify-end gap-x-4">
                       <x-button flat label="Cancel" x-on:click="close"  />
                       <x-button  label="Add Land" wire:click="addland" spinner="" emerald />
                   </div>
               </x-slot>
           </x-card>
       </x-modal>


       <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Land">
            <div class="space-y-3">
                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Location" wire:model="location" placeholder="" />
                <x-input label="Price" placeholder="" wire:model="price" />
                <x-input label="Land Measurement" placeholder="" wire:model="landmeasurement" />
                <x-input label="Photo" placeholder="" wire:model="photo" type="file"/>
                @if ($photo)
                <div>
                    <p class="text-xs text-gray-500">Photo Preview:</p>
                    <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-20 h-16 rounded">
                </div>
                @endif
                <x-input label="Video" placeholder="" wire:model="video" type="file"/>
                @if ($video)
                <div>
                    <p class="text-xs text-gray-500">Video Preview:</p>
                    <video width="200" height="100" controls>
                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                @endif
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  />
                    <x-button label="Update Land" wire:click="updateLand({{ $selectedLandId }})" spinner="" emerald />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

   </div>

