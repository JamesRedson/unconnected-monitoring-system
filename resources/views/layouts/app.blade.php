<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  {{-- fonts --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/unconnected.webp') }}">

  {{-- css --}}
  @vite('resources/css/app.css')
  @stack('styles')

  @livewireStyles
</head>

<body class="font-sans antialiased">
  <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.sidebar')


    {{-- Page Content --}}
    <div class="flex flex-col w-full h-screen">
      @include('layouts.navigation')

      <main id="main" class="main flex-1 overflow-y-auto">
        {{ $slot }}
      </main>
    </div>
  </div>

  @livewireScripts
  @vite('resources/js/app.js')
  <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
  @stack('scripts')

</body>

</html>
