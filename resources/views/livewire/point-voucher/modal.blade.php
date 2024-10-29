<div>

  {{-- create --}}
  <x-modal name="create-point-voucher" maxWidth="lg" focusable>

    <div class="p-6">
      <div class="flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6 text-teal-600 dark:text-teal-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
        </svg>

      </div>

      <form wire:submit="store">

        <div class="mt-2">
          <h3 class="text-lg text-center font-medium leading-6 text-gray-800 capitalize dark:text-white"
            id="modal-title">
            Add Point Voucher's Information</h3>

          <div class="mt-3">
            <x-input-label for="site_id" :value="__('Site Deployment Area')" />
            <select id="sites" wire:model="site_id"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm">
              <option value="">--Select Site Deployment Area--</option>
              @forelse($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
              @empty
                <option value="">No sites available</option>
              @endforelse
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('site_id')" />
          </div>


          <div class="mt-3">
            <x-input-label for="name" :value="__('Point Voucher Name')" />
            <x-text-input id="name" wire:model="name" type="text"
              class="mt-1 block w-full focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
              :value="old('name')" placeholder="Ex. (Name, Point Voucher Number)" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>

          <div class="grid grid-cols-2 gap-4 mt-3">
            <div class="col-span-1 mt-2">
              <x-input-label for="latitude" :value="__('Latitude')" />
              <x-text-input id="latitude" wire:model="latitude" type="text"
                class="mt-1 block w-full focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                :value="old('latitude')" placeholder="Latitude" autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
            </div>

            <div class="col-span-1 mt-2">
              <x-input-label for="longitude" :value="__('Longitude')" />
              <x-text-input id="longitude" wire:model="longitude" type="text"
                class="mt-1 block w-full focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                :value="old('longitude')" placeholder="Longitude" autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
            </div>
          </div>

          <div class="mt-3">
            <a class="text-teal-500 dark:text-teal-400 hover:underline" target="_blank"
              href="https://www.gps-coordinates.net/">How to get latitude and
              longitude?</a>
          </div>

        </div>

        <div class="mt-6 flex justify-end">
          <x-secondary-button wire:click="closeModal('create-point-voucher')"
            class="focus:ring-teal-700 dark:focus:ring-teal-700">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ms-3 dark:bg-teal-400 dark:hover:text-white dark:hover:bg-teal-600">
            {{ __('Save') }}
          </x-primary-button>
        </div>

      </form>

    </div>

  </x-modal>

  {{-- edit --}}
  <x-modal name="edit-point-voucher" maxWidth="lg" focusable>

    <div class="p-6">
      <div class="flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="size-6 text-teal-600 dark:text-teal-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
        </svg>

      </div>

      <form wire:submit="update">

        <div class="mt-2">
          <h3 class="text-lg text-center font-medium leading-6 text-gray-800 capitalize dark:text-white"
            id="modal-title">
            Edit Point Voucher's Information</h3>

          <div class="mt-3">
            <x-input-label for="name" :value="__('Point Voucher Name')" />
            <x-text-input id="name" wire:model="name" type="text"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
              :value="old('name')" placeholder="Ex. (Name, Point Voucher Number)" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>

          <div class="grid grid-cols-2 gap-4 mt-3">
            <div class="col-span-1 mt-2">
              <x-input-label for="latitude" :value="__('Latitude')" />
              <x-text-input id="latitude" wire:model="latitude" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                :value="old('latitude')" placeholder="Latitude" autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
            </div>

            <div class="col-span-1 mt-2">
              <x-input-label for="longitude" :value="__('Longitude')" />
              <x-text-input id="longitude" wire:model="longitude" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                :value="old('longitude')" placeholder="Longitude" autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
            </div>
          </div>

          <div class="mt-3">
            <a class="text-teal-500 dark:text-teal-400 hover:underline" target="_blank"
              href="https://www.gps-coordinates.net/">How to get latitude and
              longitude?</a>
          </div>

        </div>

        <div class="mt-6 flex justify-end">
          <x-secondary-button wire:click="closeModal('edit-point-voucher')" class="dark:focus:ring-teal-700">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ms-3 dark:bg-teal-400 dark:hover:text-white dark:hover:bg-teal-600">
            {{ __('Update') }}
          </x-primary-button>
        </div>

      </form>

    </div>

  </x-modal>

  {{-- delete --}}
  <x-modal name="delete-point-voucher" maxWidth="lg" focusable>

    <div class="p-6">
      <div class="flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="size-6 text-red-600 dark:text-red-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
        </svg>
      </div>

      <div class="mt-2 text-center">
        <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
          Delete
          Confirmation</h3>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Are you sure you want to delete the selected point voucher's information?
        </p>
      </div>

      <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="closeModal('delete-point-voucher')" class="dark:focus:ring-teal-400">
          {{ __('No') }}
        </x-secondary-button>

        <x-danger-button wire:click="destroy" class="ms-3">
          {{ __('Delete') }}
        </x-danger-button>
      </div>

    </div>

  </x-modal>

</div>
