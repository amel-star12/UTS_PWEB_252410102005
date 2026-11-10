@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="hero">
    <div class="hero-text">
        <h1>Halo, {{ $username }}!</h1>
        <p>Mau dengar apa hari ini? Lanjutkan dari lagu terakhirmu atau pilih playlist di bawah.</p>
    </div>

    <div class="now card">
        <div class="disc spin" aria-hidden="true"></div>
        <div>
            <div class="muted small">Sedang diputar</div>
            <h2>{{ $nowPlaying['judul'] }}</h2>
            <p>{{ $nowPlaying['artis'] }} &middot; {{ $nowPlaying['album'] }}</p>
            <div class="progress" aria-hidden="true"><span></span></div>
            <div class="muted small">{{ $nowPlaying['durasi'] }}</div>
        </div>
    </div>
</section>

<section class="stats">
    @foreach ($stats as $label => $value)
        <x-stat-card :label="$label" :value="$value" />
    @endforeach
</section>

<section>
    <h2 class="section-title">Playlist kamu</h2>
    <div class="grid">
        @foreach ($playlists as $playlist)
            <article class="card playlist tone-{{ $playlist['warna'] }}" role="button" tabindex="0">
                <h3>{{ $playlist['nama'] }}</h3>
                <p>{{ $playlist['deskripsi'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section>
    <h2 class="section-title">Terakhir didengar</h2>
    <ul class="list card">
        @foreach ($recent as $song)
            <li role="button" tabindex="0">
                <div>
                    <strong>{{ $song['judul'] }}</strong>
                    <span class="muted">{{ $song['artis'] }}</span>
                </div>
                <span class="muted">{{ $song['durasi'] }}</span>
            </li>
        @endforeach
    </ul>
</section>
@endsection
