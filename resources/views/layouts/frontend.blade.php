<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
    <title>@yield('title', 'My Awesome Website')</title>
    <meta name="description" content="@yield('meta_description', 'Default description for SEO')">

    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">

    <!-- Frontend Navbar -->
   @include('component.nav')

    <!-- Main Content Dynamic Area -->
    <main class="container mx-auto">
        @yield('content')
    </main>

    <!-- Frontend Footer -->
   @include('component.footer')



</body>

</html>
