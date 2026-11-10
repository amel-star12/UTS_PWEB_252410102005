@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('content')
<h1>Pengelolaan Lagu</h1>
<p class="lead">Kelola semua koleksi musik dan playlist kamu dalam satu tempat.</p>

<section>
    <h2 class="section-title">Playlist</h2>
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
    <h2 class="section-title">Semua Lagu</h2>

    <div class="search-filter-bar">
        {{-- Search Box --}}
        <form class="search-box" method="GET" action="{{ route('pengelolaan') }}">
            <input type="hidden" name="username" value="{{ $username }}">
            @if($genre)
                <input type="hidden" name="genre" value="{{ $genre }}">
            @endif
            <input 
                type="search" 
                name="search" 
                class="search-input"
                placeholder="Cari judul, artis, atau album..."
                value="{{ $search ?? '' }}"
                aria-label="Cari lagu">
            <button type="submit" class="search-btn" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>
        </form>

        {{-- Genre Filter Chips --}}
        <div class="chips" role="group" aria-label="Filter genre">
            <a href="{{ route('pengelolaan', ['username' => $username, 'search' => $search]) }}"
               class="chip {{ $genre ? '' : 'on' }}">Semua</a>
            @foreach ($genres as $g)
                <a href="{{ route('pengelolaan', ['username' => $username, 'genre' => $g, 'search' => $search]) }}"
                   class="chip {{ $genre === $g ? 'on' : '' }}">{{ $g }}</a>
            @endforeach
        </div>
    </div>

    {{-- Search Results Info --}}
    @if($search)
        <div class="search-info">
            <p>
                Menampilkan {{ count($songs) }} hasil untuk 
                <strong>"{{ $search }}"</strong>
                @if($genre)
                    di genre <strong>{{ $genre }}</strong>
                @endif
            </p>
        </div>
    @endif

    <div class="table-wrap card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Artis</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Playlist</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $song)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $song['judul'] }}</strong></td>
                        <td>{{ $song['artis'] }}</td>
                        <td>{{ $song['album'] }}</td>
                        <td>{{ $song['genre'] }}</td>
                        <td>{{ $song['playlist'] }}</td>
                        <td>{{ $song['durasi'] }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="muted">Belum ada lagu di genre ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
