@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<section class="login">
    <div class="login-intro">
        <div class="disc spin" aria-hidden="true"></div>
        <h1>Semua lagu favoritmu, dalam satu tempat</h1>
        <p>Masuk untuk melihat playlist dan mengatur daftar lagumu dengan mudah dan menyenangkan.</p>
    </div>

    <form class="card form" method="POST" action="{{ route('login.process') }}" novalidate>
        @csrf
        <h2>Masuk ke Putar</h2>

        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username') }}"
               placeholder="Masukkan username kamu"
               autocomplete="username" autofocus required>
        @error('username') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password"
               placeholder="Masukkan password"
               autocomplete="current-password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <button class="btn" type="submit"><span>Masuk Sekarang</span></button>
    </form>
</section>
@endsection
