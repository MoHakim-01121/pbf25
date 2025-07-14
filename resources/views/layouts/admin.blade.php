<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Admin' }} - TokoKami</title>

  <!-- Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
  <div class="min-h-screen flex">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main content --}}
    <div class="flex-1 flex flex-col min-h-screen">
      
      {{-- Topbar --}}
      @include('components.topbar')

      {{-- Halaman konten --}}
      <main class="flex-1 p-6 overflow-y-auto bg-gray-50">
        <div class="max-w-7xl mx-auto">
          @if (isset($header))
            <header class="bg-white shadow-sm rounded-lg mb-6">
              <div class="py-4 px-6">
                {{ $header }}
              </div>
            </header>
          @endif

          @yield('content')
        </div>
      </main>
    </div>
  </div>

  @stack('scripts')
</body>
</html>
