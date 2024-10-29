<div>

  {{-- create --}}
  <x-modal name="create-sales-report" maxWidth="lg" focusable>

    <div class="p-6">
      <div class="flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6 text-teal-600 dark:text-teal-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>


      </div>

      <form wire:submit="store">

        <div class="mt-2">
          <h3 class="text-lg text-center font-medium leading-6 text-gray-800 capitalize dark:text-white"
            id="modal-title">
            Add Sales Report's Information</h3>

          <div class="mt-3">
            <x-input-label for="site_id" :value="__('Site Deployment Area')" />
            <select id="site_id" wire:model.change="site_id"
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
            <x-input-label for="point_voucher_id" :value="__('Point Voucher Name')" />
            <select id="point_voucher_id" wire:model="point_voucher_id"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm">
              <option value="">--Select Point Vouchers Area--</option>
              @forelse($pointVouchers as $pointVoucher)
                <option value="{{ $pointVoucher->id }}">{{ $pointVoucher->name }}</option>
              @empty
                <option value="">No Point Vouchers available</option>
              @endforelse
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('point_voucher_id')" />
          </div>

          <div class="mt-3">
            <x-input-label for="voucher_price" :value="__('Voucher Price')" />
            <select id="voucher_price" wire:model.live="voucher_price" wire:change="updateTotalAmount('voucher_price')"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm">
              <option value="">--Select Voucher Price--</option>
              @foreach (config('constants.voucher_price') as $voucherPrice)
                <option value="{{ $voucherPrice }}">{{ $voucherPrice }}</option>
              @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('voucher_price')" />
          </div>


          <div class="mt-3">
            <x-input-label for="total_voucher_sales" :value="__('Total Voucher Sales')" />
            <x-text-input id="total_voucher_sales" wire:model.live="total_voucher_sales"
              wire:change="updateTotalAmount('total_voucher_sales')" type="number"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
              :value="old('name')" placeholder="Total Voucher Sales" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('total_voucher_sales')" />
          </div>

          <div class="mt-3">
            <x-input-label for="total_amount" :value="__('Total Amount')" />
            <x-text-input id="total_amount" wire:model="total_amount" type="number"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
              placeholder="Total Amount" autofocus readonly />
            <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
          </div>

          <div class="mt-3">
            <x-input-label for="reported_at" :value="__('Report Date')" />
            <x-text-input id="reported_at" wire:model="reported_at" type="date"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
              autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('reported_at')" />
          </div>

        </div>

        <div class="mt-6 flex justify-end">
          <x-secondary-button wire:click="closeModal('create-sales-report')">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ms-3 dark:bg-teal-400">
            {{ __('Save') }}
          </x-primary-button>
        </div>

      </form>

    </div>

  </x-modal>

  {{-- edit --}}
  <x-modal name="edit-sales-report" maxWidth="lg" focusable>

    <div class="p-6">
      <div class="flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="size-6 text-teal-600 dark:text-teal-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>
      </div>

      <form wire:submit="update">

        <div class="mt-2">
          <h3 class="text-lg text-center font-medium leading-6 text-gray-800 capitalize dark:text-white"
            id="modal-title">
            Edit Sales Report's Information</h3>

          <div class="mt-3">
            <x-input-label for="voucher_price" :value="__('Voucher Price')" />
            <select id="voucher_price" wire:model.live="voucher_price" wire:change="updateTotalAmount('voucher_price')"
              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
              <option value="">--Select Voucher Price--</option>
              @foreach (config('constants.voucher_price') as $voucherPrice)
                <option value="{{ $voucherPrice }}">{{ $voucherPrice }}</option>
              @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('voucher_price')" />
          </div>

          <div class="mt-3">
            <x-input-label for="total_voucher_sales" :value="__('Total Voucher Sales')" />
            <x-text-input id="total_voucher_sales" wire:model.live="total_voucher_sales"
              wire:change="updateTotalAmount('total_voucher_sales')" type="number" class="mt-1 block w-full"
              :value="old('name')" placeholder="Total Voucher Sales" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('total_voucher_sales')" />
          </div>

          <div class="mt-3">
            <x-input-label for="total_amount" :value="__('Total Amount')" />
            <x-text-input id="total_amount" wire:model="total_amount" type="number" class="mt-1 block w-full"
              placeholder="Total Amount" autofocus readonly />
            <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
          </div>

          <div class="mt-3">
            <x-input-label for="reported_at" :value="__('Report Date')" />
            <x-text-input id="reported_at" wire:model="reported_at" type="date" class="mt-1 block w-full"
              :value="old('reported_at')" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('reported_at')" />
          </div>

        </div>

        <div class="mt-6 flex justify-end">
          <x-secondary-button wire:click="closeModal('edit-sales-report')">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ms-3 dark:bg-teal-400">
            {{ __('Save') }}
          </x-primary-button>
        </div>

      </form>

    </div>

  </x-modal>

  {{-- delete --}}
  <x-modal name="delete-sales-report" maxWidth="lg" focusable>

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
        <x-secondary-button wire:click="closeModal('delete-sales-report')">
          {{ __('No') }}
        </x-secondary-button>

        <x-danger-button wire:click="destroy" class="ms-3">
          {{ __('Delete') }}
        </x-danger-button>
      </div>

    </div>

  </x-modal>

</div>
