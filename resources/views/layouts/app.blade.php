<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('title', config('app.name'))</title>
  <meta name="description" content="@yield('meta_description', '')">
  {{-- If you also want a separate meta_title, keep it too: --}}
  @php
    $ogTitle = trim($__env->yieldContent('meta_title'))
        ?: trim($__env->yieldContent('title'))
        ?: config('app.name');
@endphp

<meta property="og:title" content="{{ $ogTitle }}">
  <meta property="og:description" content="@yield('meta_description', '')">

  {{-- ... the rest of your head ... --}}
  {{-- Bootstrap & Fonts (from your HTML) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- Your theme CSS in public/assets --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  @stack('styles')
</head>
<body>
  @include('partials.header')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  {{-- Bootstrap bundle + your theme JS in public/assets --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>