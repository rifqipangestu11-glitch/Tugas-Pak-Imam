@extends('layouts.app')

@section('content')
<div class="page-shell">
    <div class="outer-card">
        <header class="page-header">
            <div class="brand">Perpustakaan Sekolah</div>
            <nav class="page-nav">
                <a href="#">Beranda</a>
                <a href="#">Request Buku</a>
                <a href="#">Kontak</a>
            </nav>
            <div class="header-action">DEMO E-UJIAN</div>
        </header>

        <section class="hero-section">
            <div class="hero-left">
                <span class="hero-badge">Online E-ujian.id</span>
                <h1>Cara Menggunakan Aplikasi Perpustakaan Sekolah</h1>
                <p>Kelola buku sekolah secara online, lakukan peminjaman dan pengembalian, serta monitor denda keterlambatan dengan mudah.</p>

                <div class="info-card">
                    <div>
                        <p class="info-title">Akun Demo</p>
                        <p class="info-text">Email: admin@perpus.test</p>
                        <p class="info-text">Password: password</p>
                    </div>
                </div>
            </div>

            <div class="hero-right">
                <div class="login-card">
                    <h2>Masuk ke Sistem</h2>
                    <p>Gunakan akun perpustakaan untuk mengakses dashboard.</p>

                    <form action="{{ route('login') }}" method="POST" class="login-form">
                        @csrf
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="masukkan email" />

                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required placeholder="masukkan password" />

                        <label class="checkbox-row">
                            <input type="checkbox" name="remember" />
                            Ingat saya
                        </label>

                        <button type="submit">Masuk</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Daftar Buku</h3>
                <p>Lihat koleksi buku yang tersedia dalam perpustakaan sekolah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📝</div>
                <h3>Peminjaman Cepat</h3>
                <p>Pinjam buku dengan mudah dan segera cek status peminjaman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔁</div>
                <h3>Pengembalian</h3>
                <p>Kembalikan buku tepat waktu dan lihat detail riwayat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Denda Otomatis</h3>
                <p>Hitung denda keterlambatan secara otomatis saat pengembalian.</p>
            </div>
        </section>
    </div>
</div>
@endsection
