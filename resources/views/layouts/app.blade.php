<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','CareerPath')</title>

    <!-- هاد السطر ضفته مشان يشتغلوا التنسيقات بعد ما رفعت الموقع على النت -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- هاد السطر مشان زر قسم المفضلة -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('components.navbar')
    @include('components.favorite-sidebar')
    <main class="container py-4">
        @yield('content')
    </main>
    @include('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')


    <script src="{{ asset('js/favorites.js') }}"></script>

</body>
</html>