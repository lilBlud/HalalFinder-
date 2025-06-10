<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halal Food Finder - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    @include('partials.header')
    
    <main class="container py-4">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    @yield('scripts')
</body>
</html>