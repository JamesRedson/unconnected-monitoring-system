<aside
  class="flex flex-col w-[300px] h-screen px-4 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">

  <div class="flex flex-col justify-between flex-1 mt-6">
    <nav>
      <div class="space-y-3 mb-5">
        @foreach (config('constants.sidebarMenu') as $item)
          <div>
            <label class="block mb-2 mt-3 px-3 text-xs text-gray-500 uppercase dark:text-gray-400">{{ $item['label'] }}</label>
            <a class="flex items-center px-4 py-2 text-gray-600 rounded-lg dark:text-gray-400 hover:bg-green-100 dark:hover:bg-gray-800 dark:hover:text-green-400 hover:text-gray-700
            {{ Request::routeIs($item['route']) ? 'bg-green-100 text-gray-900 dark:text-green-400 dark:bg-gray-800' : '' }}"
              href="{{ route($item['route']) }}">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="{{ $item['icon'] }}" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="mx-4 font-medium">{{ $item['title'] }}</span>
            </a>
          </div>
        @endforeach
      </div>
    </nav>
  </div>
</aside>
