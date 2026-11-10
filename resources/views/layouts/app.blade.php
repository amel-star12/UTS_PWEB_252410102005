<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>@yield('title', 'Playlist') · Putar</title>
</head>
<body class="{{ isset($username) ? 'with-nav' : 'guest' }}">

    {{-- Navbar hanya tampil setelah login (saat $username dikirim controller) --}}
    @isset($username)
        <x-navbar :username="$username" />
    @endisset

    <main class="container">
        @yield('content')
    </main>

    <x-footer />

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
