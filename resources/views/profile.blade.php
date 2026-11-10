@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<section class="profile card">
    <div class="avatar" aria-hidden="true">{{ strtoupper(substr($username, 0, 1)) }}</div>
    <div>
        <h1>{{ $username }}</h1>
        <p class="muted">{{ $email }}</p>
        <p class="muted">Bergabung sejak {{ $bergabung }}</p>
    </div>
</section>

<div class="two-col">
    <section>
        <h2 class="section-title">Genre Favorit</h2>
        <div class="chips">
            @foreach ($genreFavorit as $genre)
                <span class="chip on">{{ $genre }}</span>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="section-title">Artis Teratas</h2>
        <ol class="list card">
            @foreach ($artisTeratas as $index => $artis)
                <li>
                    <strong>{{ $artis }}</strong>
                </li>
            @endforeach
        </ol>
        <p class="muted small">Total {{ $totalLagu }} lagu di koleksimu.</p>
    </section>
</div>
@endsection
