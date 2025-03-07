<div>

  <div class="mt-6 md:flex md:items-center md:justify-between">
    <div class="relative flex items-center mt-4 md:mt-0">
      <span class="absolute">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
      </span>

      <input type="search" placeholder="Search client ..." wire:model.live.throttle.250ms="search" autofocus
        class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-teal-400 dark:focus:border-teal-300 focus:ring-teal-300 focus:outline-none focus:ring focus:ring-opacity-40">
    </div>
  </div>

  <div class="flex flex-col mt-6">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
              <tr>

                <th scope="col"
                  class="py-3.5 px-4 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Full Name
                </th>

                <th scope="col"
                  class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Sex
                </th>

                <th scope="col"
                  class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Age
                </th>

                <th scope="col"
                  class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Voucher
                </th>

                <th scope="col"
                  class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  MAC Address
                </th>

                <th scope="col"
                  class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Site Name
                </th>

              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

              @forelse ($clients as $client)
                <tr>
                  <td class="px-12 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->first_name }} {{ $client->last_name }}
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->sex }}
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->age }}
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->voucher }}
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->mac_address }}
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    {{ $client->site_name }}
                  </td>
                </tr>

              @empty

                <tr>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap text-center"
                    colspan="6">No data.</td>
                </tr>
              @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6">
    {{ $clients->links() }}
  </div>

</div>
