<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          {{-- table --}}
          <section class="container px-4 mx-auto">

            <div class="sm:flex sm:items-center sm:justify-between">
              <div>
                <div class="flex items-center gap-x-3">
                  <h2 class="text-lg font-medium text-gray-800 dark:text-white">Clients</h2>

                  <span
                    class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $totalClients }}</span>
                </div>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These are all the registered clients in the
                  system.</p>
              </div>

            </div>

            <livewire:client.client-list />

          </section>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
