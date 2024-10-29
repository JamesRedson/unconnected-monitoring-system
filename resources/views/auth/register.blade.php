<x-guest-layout>
  <form action="{{ route('register') }}" method="POST" class="w-full max-w-full mx-auto">
    @csrf

    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg border dark:bg-gray-800 lg:max-w-4xl">
      <div class="hidden bg-contain bg-no-repeat lg:block lg:w-1/2 mt-20 ml-10"
        style="background-image: url('{{ asset('img/unconnected.webp') }}');">
      </div>

      <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
        <div class="mt-4">
          <input id="name" name="name"
            class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-green-400 focus:ring-opacity-40 dark:focus:border-green-300 focus:outline-none focus:ring focus:ring-green-300"
            type="text" placeholder="Username" />
        </div>

        <div class="mt-4">
          <input id="email" name="email"
            class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-green-400 focus:ring-opacity-40 dark:focus:border-green-300 focus:outline-none focus:ring focus:ring-green-300"
            type="email" placeholder="Email Address" />
        </div>

        <div class="mt-4">
          <input id="password" name="password"
            class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-green-400 focus:ring-opacity-40 dark:focus:border-green-300 focus:outline-none focus:ring focus:ring-green-300"
            type="password" placeholder="Password" />
        </div>

        <div class="mt-4">
          <input id="password_confirmation" name="password_confirmation"
            class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-green-400 focus:ring-opacity-40 dark:focus:border-green-300 focus:outline-none focus:ring focus:ring-green-300"
            type="password" placeholder="Confirm Password" />
        </div>


        <div class="mt-6">
          <button
            class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50 dark:bg-green-700 dark:hover:bg-green-500">
            Register
          </button>
        </div>

        <div class="flex items-center justify-between mt-10">
          <span class="w-3/5 border-b dark:border-gray-600 md:w-1/4"></span>

          <a href="{{ route('login') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-green-700">Already
            have an account? Sign In</a>

          <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
        </div>

      </div>
    </div>
  </form>
</x-guest-layout>
