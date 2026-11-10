# 🎵 Putar - Music Playlist App

Aplikasi manajemen playlist musik modern yang dibangun dengan **Laravel 11** menggunakan konsep **MVC murni**, **Blade templating**, dan **tanpa database**.

## 📋 Deskripsi

Aplikasi web untuk mengelola playlist musik dengan tampilan modern, responsif, dan interaktif. Dibuat untuk pembelajaran konsep MVC, routing, controller, views, dan Blade components dalam Laravel.

## ✨ Fitur Utama

- 🔐 **Login** - Form login dengan validasi Laravel
- 🏠 **Dashboard** - Overview playlist, statistik, dan now playing
- 📚 **Pengelolaan** - Daftar lagu dengan filter genre dan pencarian
- 👤 **Profil** - Informasi user dan preferensi musik
- 🔍 **Search** - Cari lagu berdasarkan judul, artis, atau album

## 🎨 Teknologi

- **Backend:** Laravel 11, PHP 8.2+
- **Frontend:** Pure CSS3, Vanilla JavaScript
- **Design:** Dark theme, gradient colors, smooth animations
- **Icons:** Emoji & custom SVG
- **Fonts:** Google Fonts (Space Grotesk, Inter)

## 🚀 Instalasi

```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Jalankan server
php artisan serve
```

Buka browser: **http://localhost:8000**

## 🔐 Login

Aplikasi menggunakan simulasi login (tanpa database):

- **Username:** apa saja (min. 3 karakter, alfanumerik)
- **Password:** apa saja (min. 4 karakter)

Contoh:
- Username: `admin`, `user123`, `john`
- Password: `password`, `1234`

## 📁 Struktur

```
├── app/Http/Controllers/
│   └── PageController.php          # Controller utama
│
├── routes/
│   └── web.php                     # Route definitions
│
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php          # Master layout
│   ├── partials/
│   │   └── head.blade.php         # Head section
│   ├── components/
│   │   ├── navbar.blade.php       # Navigation bar
│   │   ├── footer.blade.php       # Footer
│   │   └── stat-card.blade.php    # Stat card component
│   ├── login.blade.php            # Login page
│   ├── dashboard.blade.php        # Dashboard page
│   ├── pengelolaan.blade.php      # Management page
│   └── profile.blade.php          # Profile page
│
└── public/
    ├── css/
    │   └── style.css              # Main stylesheet (21 KB)
    ├── js/
    │   └── app.js                 # JavaScript interactions (13 KB)
    └── images/
        └── vinyl-icon.svg         # Logo/icon
```

## 🎨 Fitur Visual

- **Dark Theme** - Background gradient dengan particle animation
- **Vinyl Animation** - Piringan hitam berputar (klik untuk pause/play)
- **Responsive** - Mobile-first design (breakpoints: 900px, 600px)
- **Smooth Animations** - Fade-in, hover effects, transitions
- **Custom Scrollbar** - Gradient scrollbar
- **Interactive Cards** - Hover effects, ripple animations

## 📱 Responsive

- **Desktop (> 900px):** Full layout, multi-column grids
- **Tablet (600-900px):** 2-column grids, hamburger menu
- **Mobile (< 600px):** Single column, stacked layout

## 🎯 Halaman

### 1. Login (`/`)
Form login dengan validasi, animated vinyl disc

### 2. Dashboard (`/dashboard?username=NAMA`)
Now playing section, statistics, playlist grid, recent songs

### 3. Pengelolaan (`/pengelolaan?username=NAMA`)
Tabel lagu, filter genre, pencarian lagu, playlist cards

### 4. Profile (`/profile?username=NAMA`)
User info, genre favorit, top artists

## 🎨 Customization

### Mengubah Warna

Edit `public/css/style.css`:

```css
:root {
  --pink: #ff4d8a;
  --cyan: #4ee8ff;
  --violet: #a385ff;
}
```

### Menambah Lagu

Edit `app/Http/Controllers/PageController.php`, method `songs()`:

```php
private function songs(): array
{
    return [
        [
            'judul' => 'Judul Lagu',
            'artis' => 'Nama Artis',
            'album' => 'Nama Album',
            'genre' => 'Genre',
            'durasi' => '3:45',
            'playlist' => 'Nama Playlist'
        ],
        // ...
    ];
}
```

### Menambah Playlist

Edit `app/Http/Controllers/PageController.php`, method `playlists()`:

```php
private function playlists(): array
{
    return [
        [
            'nama' => 'Playlist Baru',
            'deskripsi' => 'Deskripsi playlist',
            'warna' => 'cyan' // cyan, violet, pink, atau amber
        ],
        // ...
    ];
}
```

### Menambah Gambar

1. Taruh file di `public/images/`
2. Gunakan di Blade: `{{ asset('images/nama-file.jpg') }}`

## ⌨️ Keyboard Shortcuts

- **Ctrl/Cmd + K** - Focus search box
- **Escape** - Clear search / Close mobile menu
- **Ctrl + Shift + R** - Hard refresh

## ✅ Ketentuan yang Dipenuhi

- ✅ Struktur file sesuai (routes, controllers, views)
- ✅ Layout menggunakan Blade components
- ✅ Tampilan responsif (mobile, tablet, desktop)
- ✅ Visual menarik dengan animasi
- ✅ Zero "Lorem Ipsum"
- ✅ Menggunakan helper `asset()` untuk aset
- ✅ Form validasi Laravel
- ✅ Tanpa database (data hardcoded)
- ✅ Tanpa starter kit Laravel

## 🎯 Fitur Kreatif

1. **Vinyl Record Animation** - Piringan hitam 3D dengan glow effect
2. **Particle Background** - Floating particles untuk depth
3. **Gradient Design** - Text, buttons, cards dengan gradient
4. **Smooth Transitions** - Semua interaksi dengan ease (0.3s)
5. **Ripple Effect** - Material Design ripple pada cards
6. **Intersection Observer** - Lazy animations saat scroll
7. **Custom Scrollbar** - Scrollbar dengan gradient
8. **Keyboard Shortcuts** - Power user features

## 🛠️ Troubleshooting

### CSS/JS tidak muncul
```bash
# Hard refresh browser
Ctrl + Shift + R
```

### Route not found
```bash
php artisan route:clear
```

### View not found
```bash
php artisan view:clear
```

## 📊 Statistik

- **CSS:** ~1500 lines (pure CSS, no framework)
- **JavaScript:** ~400 lines (vanilla JS, no jQuery)
- **Views:** 9 Blade templates
- **Routes:** 5 routes
- **Controller Methods:** 5 methods

## 🌟 Highlight

- ❌ **Tanpa Database** - Semua data di controller
- ❌ **Tanpa Starter Kit** - Pure Laravel MVC
- ❌ **Tanpa CSS Framework** - Custom CSS
- ❌ **Tanpa JS Library** - Vanilla JavaScript
- ✅ **100% Custom Design**

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran Laravel MVC & Blade.

---

**Semester 3 - Pemrograman Web**

Dibuat dengan 💜 menggunakan Laravel 11
