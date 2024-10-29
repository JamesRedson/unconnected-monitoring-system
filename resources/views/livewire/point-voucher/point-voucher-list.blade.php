<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900 dark:text-gray-100">

        {{-- table --}}
        <section class="container px-4 mx-auto">

          <div class="sm:flex sm:items-center sm:justify-between">
            <div>
              <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Point Vouchers</h2>

                <span class="px-3 py-1 text-xs text-white bg-teal-500 rounded-full">{{ $totalPointVouchers }}</span>
              </div>

              <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These are all the registered
                point vouchers in the
                system.</p>
            </div>

            <div class="flex items-center mt-4 gap-x-3">

              <button wire:click="$dispatch('add-point-voucher')"
                class="ml-auto inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-900 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-5 h-5 mx-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="mx-1">Add</span>
              </button>

            </div>

          </div>

          <div>

            <div class="mt-6 md:flex md:items-center md:justify-between">
              <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
                </span>

                <input type="search" placeholder="Search point voucher ..." wire:model.live.throttle.250ms="search"
                  autofocus
                  class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-teal-400 dark:focus:border-teal-300 focus:ring-teal-300 focus:outline-none focus:ring focus:ring-opacity-40">
              </div>
            </div>

            <div class="flex flex-col mt-6">
              <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                  <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                      <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr class="text-left">

                          <th scope="col"
                            class="py-3.5 px-4 text-sm font-bold rtl:text-right text-gray-500 dark:text-gray-400">
                            Site Deployment Area
                          </th>

                          <th scope="col"
                            class="py-3.5 px-4 text-sm font-bold rtl:text-right text-gray-500 dark:text-gray-400">
                            Point Voucher Name
                          </th>

                          <th scope="col"
                            class="px-4 py-3.5 text-sm font-bold rtl:text-right text-gray-500 dark:text-gray-400">
                          </th>

                        </tr>
                      </thead>

                      <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                        @forelse ($pointVouchers as $pointVoucher)
                          <tr>

                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                              {{ $pointVoucher->site->name }}
                            </td>

                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                              {{ $pointVoucher->name }}
                            </td>

                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                              <div class="flex justify-start gap-x-6">

                                {{-- edit --}}
                                <div class="flex items-center">
                                  <button
                                    wire:click="$dispatch('edit-point-voucher', { pointVoucher: '{{ $pointVoucher->id }}' })"
                                    class="inline-flex items-center gap-2 text-gray-500 transition-colors duration-200 dark:hover:text-teal-500 dark:text-gray-300 hover:text-teal-500 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                      stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d=" m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5
                                  0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18
                                  14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1
                                  5.25 6H10" />
                                    </svg>
                                    Edit
                                  </button>
                                </div>

                                {{-- delete --}}
                                <button
                                  wire:click="$dispatch('delete-point-voucher', { pointVoucher: '{{ $pointVoucher->id }}' })"
                                  class="inline-flex items-center gap-2 text-red-500 transition-colors duration-200 dark:text-red-500 focus:outline-none">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d=" M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107
                                  1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0
                                  01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12
                                  .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5
                                  0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09
                                  1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>
                                  Delete
                                </button>

                              </div>
                            </td>

                          </tr>

                        @empty

                          <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap text-center"
                              colspan="8">No data.</td>
                          </tr>
                        @endforelse

                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="mt-6">
            {{ $pointVouchers->links() }}
          </div>

          <livewire:point-voucher.modal />

        </section>

      </div>
    </div>
  </div>
</div>
