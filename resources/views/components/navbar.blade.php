@props(['username'])

<header class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="{{ route('dashboard', ['username' => $username]) }}">
            <img src="{{ asset('images/vinyl-icon.svg') }}" alt="Logo" style="width:32px;height:32px;vertical-align:middle;">
            Putar
        </a>

        <button id="nav-toggle" class="nav-toggle" aria-expanded="false" aria-controls="nav-menu">Menu</button>

        <nav id="nav-menu" class="nav-menu" aria-label="Navigasi utama">
            <a href="{{ route('dashboard', ['username' => $username]) }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}"
               class="{{ request()->routeIs('pengelolaan') ? 'active' : '' }}">Pengelolaan</a>
            <a href="{{ route('profile', ['username' => $username]) }}"
               class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profil</a>
            <a href="{{ route('login') }}" class="nav-logout">Keluar</a>
        </nav>
    </div>
</header>
