<x-app-layout>

  <div class="scrollable-content gap-4">

    <section class="mt-3 container px-8 mx-auto">
      <div class="sm:flex-row sm:items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <a class="block rounded-xl border bg-white dark:bg-gray-800 border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none dark:focus:outline-none dark:border-0 focus:ring-green-600 dark:focus:ring-green-500"
            href="#">
            <span class="inline-block rounded-lg bg-gray-50 dark:bg-gray-800 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-green-500 dark:text-green-400 dark:bg-gray-800">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
              </svg>
            </span>
            <h2 class="mt-2 font-bold dark:text-white">Total Clients</h2>
            <p class="mt-1 text-3xl text-green-500 dark:text-green-400">{{ $clientCount }}</p>
          </a>

          <a class="block rounded-xl border bg-white dark:bg-gray-800 border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none dark:focus:outline-none dark:border-0 focus:ring-green-600 dark:focus:ring-green-500"
            href="#">
            <span class="inline-block rounded-lg bg-gray-50 dark:bg-gray-800 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-green-500 dark:text-green-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
              </svg>

            </span>
            <h2 class="mt-2 font-bold dark:text-white">Total Sales</h2>
            <p class="mt-1 text-3xl text-green-500 dark:text-green-400">{{ $salesCount }}</p>
          </a>

          <a class="block rounded-xl border bg-white dark:bg-gray-800 border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none dark:focus:outline-none dark:border-0 focus:ring-green-600 dark:focus:ring-green-500"
            href="#">
            <span class="inline-block rounded-lg bg-gray-50 dark:bg-gray-800 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-green-500 dark:text-green-400 dark:bg-gray-800">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
              </svg>
            </span>
            <h2 class="mt-2 font-bold dark:text-white">Total Sites</h2>
            <p class="mt-1 text-3xl text-green-500 dark:text-green-400">{{ $siteCount }}</p>
          </a>

          <a class="block rounded-xl border bg-white dark:bg-gray-800 border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none dark:focus:outline-none dark:border-0 focus:ring-green-600 dark:focus:ring-green-500"
            href="#">
            <span class="inline-block rounded-lg bg-gray-50 dark:bg-gray-800 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-green-500 dark:text-green-400 dark:bg-gray-800">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
              </svg>

            </span>
            <h2 class="mt-2 font-bold dark:text-white">Total Point Vouchers</h2>
            <p class="mt-1 text-3xl text-green-500 dark:text-green-400">{{ $pointVoucherCount }}</p>
          </a>
        </div>
      </div>
    </section>

    <div class="mt-5 mb-5 w-full h-full">
      <livewire:dashboard.chart.connected-users />
      <livewire:dashboard.chart.connected-users-by-sex />
      <livewire:dashboard.chart.connected-users-by-site />
      <livewire:dashboard.chart.connected-users-by-age />
      <livewire:dashboard.chart.salesper-site />
    </div>

</x-app-layout>
