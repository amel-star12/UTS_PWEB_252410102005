<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /* ---------- Sumber data (array, tanpa database) ---------- */

    private function songs(): array
    {
        return [
            ['judul' => 'Evaluasi',               'artis' => 'Hindia',        'album' => 'Menari dengan Bayangan', 'genre' => 'Indie', 'durasi' => '4:12', 'playlist' => 'Galau Malam'],
            ['judul' => 'Hati-Hati di Jalan',     'artis' => 'Tulus',         'album' => 'Manusia',                'genre' => 'Pop',   'durasi' => '4:08', 'playlist' => 'Pagi Santai'],
            ['judul' => 'Pamit',                  'artis' => 'Tulus',         'album' => 'Gajah',                  'genre' => 'Pop',   'durasi' => '4:37', 'playlist' => 'Galau Malam'],
            ['judul' => 'Blinding Lights',        'artis' => 'The Weeknd',    'album' => 'After Hours',            'genre' => 'Synth', 'durasi' => '3:20', 'playlist' => 'Gas Olahraga'],
            ['judul' => 'Levitating',             'artis' => 'Dua Lipa',      'album' => 'Future Nostalgia',       'genre' => 'Pop',   'durasi' => '3:23', 'playlist' => 'Gas Olahraga'],
            ['judul' => 'Bintang di Surga',       'artis' => 'Peterpan',      'album' => 'Bintang di Surga',       'genre' => 'Rock',  'durasi' => '4:31', 'playlist' => 'Pagi Santai'],
            ['judul' => 'Nina',                   'artis' => 'Feast',         'album' => 'Uang Muka',              'genre' => 'Rock',  'durasi' => '3:49', 'playlist' => 'Fokus Kerja'],
            ['judul' => 'Weightless',             'artis' => 'Marconi Union', 'album' => 'Weightless',             'genre' => 'Ambient', 'durasi' => '8:09', 'playlist' => 'Fokus Kerja'],
            ['judul' => 'Sial',                   'artis' => 'Mahalini',      'album' => 'Sial',                   'genre' => 'Pop',   'durasi' => '3:36', 'playlist' => 'Galau Malam'],
            ['judul' => 'Teardrop',               'artis' => 'Massive Attack','album' => 'Mezzanine',              'genre' => 'Ambient', 'durasi' => '5:30', 'playlist' => 'Fokus Kerja'],
        ];
    }

    private function playlists(): array
    {
        return [
            ['nama' => 'Pagi Santai',  'deskripsi' => 'Pelan, hangat, cocok buat sarapan.',  'warna' => 'cyan'],
            ['nama' => 'Fokus Kerja',  'deskripsi' => 'Minim lirik supaya tetap konsentrasi.', 'warna' => 'violet'],
            ['nama' => 'Gas Olahraga', 'deskripsi' => 'Tempo cepat untuk menaikkan semangat.', 'warna' => 'pink'],
            ['nama' => 'Galau Malam',  'deskripsi' => 'Untuk yang belum bisa tidur.',         'warna' => 'amber'],
        ];
    }

    /* ---------- Halaman ---------- */

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[A-Za-z0-9_.]+$/'],
            'password' => ['required', 'min:4'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.min'      => 'Username minimal 3 karakter.',
            'username.regex'    => 'Username hanya boleh huruf, angka, titik, dan garis bawah.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 4 karakter.',
        ]);

        // Simulasi login: password tidak dicek, username diteruskan lewat request parameter.
        return redirect()->route('dashboard', ['username' => $data['username']]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username');
        if (! $username) {
            return redirect()->route('login');
        }

        $songs = $this->songs();
        $playlists = $this->playlists();

        $totalDetik = 0;
        foreach ($songs as $song) {
            [$m, $s] = explode(':', $song['durasi']);
            $totalDetik += ((int) $m * 60) + (int) $s;
        }

        return view('dashboard', [
            'username'   => $username,
            'nowPlaying' => $songs[0],
            'recent'     => array_slice($songs, 1, 4),
            'playlists'  => $playlists,
            'stats'      => [
                'Total lagu'   => count($songs),
                'Playlist'     => count($playlists),
                'Total durasi' => intdiv($totalDetik, 60) . ' menit',
            ],
        ]);
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username');
        if (! $username) {
            return redirect()->route('login');
        }

        $songs = $this->songs();
        $genres = array_values(array_unique(array_column($songs, 'genre')));
        sort($genres);

        // Filter by genre
        $genre = $request->query('genre');
        if ($genre) {
            $songs = array_filter($songs, fn ($song) => $song['genre'] === $genre);
        }

        // Search functionality
        $search = $request->query('search');
        if ($search) {
            $searchLower = strtolower($search);
            $songs = array_filter($songs, function ($song) use ($searchLower) {
                return str_contains(strtolower($song['judul']), $searchLower)
                    || str_contains(strtolower($song['artis']), $searchLower)
                    || str_contains(strtolower($song['album']), $searchLower);
            });
        }

        return view('pengelolaan', [
            'username'  => $username,
            'songs'     => $songs,
            'playlists' => $this->playlists(),
            'genres'    => $genres,
            'genre'     => $genre,
            'search'    => $search,
        ]);
    }

    public function profile(Request $request)
    {
        $username = $request->query('username');
        if (! $username) {
            return redirect()->route('login');
        }

        $songs = $this->songs();

        return view('profile', [
            'username'      => $username,
            'email'         => strtolower($username) . '@putar.test',
            'bergabung'     => 'November 2026',
            'genreFavorit'  => ['Pop', 'Indie', 'Rock', 'Ambient'],
            'artisTeratas'  => array_slice(array_unique(array_column($songs, 'artis')), 0, 5),
            'totalLagu'     => count($songs),
        ]);
    }
}
