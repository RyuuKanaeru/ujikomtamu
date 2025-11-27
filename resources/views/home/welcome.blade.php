@extends('layouts.app')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Buku Tamu Digital PTUN Bandung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('HomeCss/landing.css') }}">
</head>
<body>

    <!-- Intro Overlay -->
    @if(!session('success'))
    <div class="intro-overlay">
        <div class="intro-content">
            <div class="intro-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h1 class="intro-title">Selamat Datang</h1>
            <p class="intro-text">di Sistem Buku Tamu Digital PTUN Bandung</p>
            <button class="intro-button">
                <span>Mulai Mengisi</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <i class="fas fa-book"></i>
                <span>Buku Tamu Digital</span>
            </div>
            <div class="navbar-links">
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">Sistem Buku Tamu Digital PTUN Bandung</h1>
                <p class="hero-subtitle">Proses pendaftaran kunjungan yang modern, transparan, dan terpercaya</p>
                <div class="hero-buttons">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Daftar Kunjungan
                    </a>
                    <a href="#layanan" class="btn btn-secondary">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="layanan-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Solusi lengkap untuk kebutuhan administrasi kunjungan</p>
            </div>
            <div class="layanan-grid">
                <div class="layanan-card">
                    <div class="card-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="card-title">Pencatatan Digital</h3>
                    <p class="card-description">Sistem pencatatan modern yang efisien, akurat, dan terorganisir dengan database terpusat</p>
                </div>
                <div class="layanan-card">
                    <div class="card-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h3 class="card-title">Proses Cepat</h3>
                    <p class="card-description">Administrasi kunjungan yang mudah dan cepat tanpa dokumen manual yang berbelit</p>
                </div>
                <div class="layanan-card">
                    <div class="card-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="card-title">Keamanan Data</h3>
                    <p class="card-description">Perlindungan data tamu dengan enkripsi dan sistem keamanan berlapis</p>
                </div>
                <div class="layanan-card">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="card-title">Laporan Analitik</h3>
                    <p class="card-description">Dashboard komprehensif dengan analisis data kunjungan dan statistik real-time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Section -->
    <section id="mengapa" class="mengapa-section">
        <div class="container">
            <div class="mengapa-content">
                <h2 class="section-title">Mengapa Sistem Ini Ada</h2>
                <p class="section-subtitle">Komitmen PTUN Bandung terhadap transformasi digital dan pelayanan prima</p>
                
                <div class="mengapa-features">
                    <div class="feature-block">
                        <div class="feature-number">01</div>
                        <h4 class="feature-heading">Transparansi Proses</h4>
                        <p class="feature-text">Memberikan kemudahan dan transparansi kepada pengunjung dalam proses pendaftaran kunjungan ke PTUN Bandung</p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-number">02</div>
                        <h4 class="feature-heading">Efisiensi Operasional</h4>
                        <p class="feature-text">Meningkatkan efisiensi manajemen kunjungan dengan sistem terintegrasi yang mengurangi beban administratif</p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-number">03</div>
                        <h4 class="feature-heading">Profesionalisme Institusional</h4>
                        <p class="feature-text">Menunjukkan komitmen PTUN Bandung dalam memanfaatkan teknologi untuk pelayanan kelas dunia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section id="statistik" class="statistik-section">
        <div class="container">
            <h2 class="section-title">Statistik Kunjungan</h2>
            <p class="section-subtitle">Data kunjungan real-time ke PTUN Bandung</p>
            
            <div class="statistik-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">2,547</div>
                        <div class="stat-label">Total Pengunjung</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">324</div>
                        <div class="stat-label">Kunjungan Bulan Ini</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">98.5%</div>
                        <div class="stat-label">Tingkat Kepuasan</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">2.3 min</div>
                        <div class="stat-label">Waktu Proses Rata-rata</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Menggunakan Section -->
    <section id="cara" class="cara-section">
        <div class="container">
            <h2 class="section-title">Cara Menggunakan Sistem</h2>
            <p class="section-subtitle">4 langkah mudah untuk mendaftar kunjungan Anda</p>
            
            <div class="langkah-grid">
                <div class="langkah-card">
                    <div class="langkah-number">1</div>
                    <h4 class="langkah-title">Kunjungi Halaman Pendaftaran</h4>
                    <p class="langkah-description">Buka halaman formulir pendaftaran dan siapkan data diri Anda</p>
                </div>
                <div class="langkah-card">
                    <div class="langkah-number">2</div>
                    <h4 class="langkah-title">Isi Data Pribadi</h4>
                    <p class="langkah-description">Masukkan informasi lengkap sesuai dengan identitas yang valid</p>
                </div>
                <div class="langkah-card">
                    <div class="langkah-number">3</div>
                    <h4 class="langkah-title">Tentukan Tujuan Kunjungan</h4>
                    <p class="langkah-description">Pilih departemen atau tujuan kunjungan Anda di PTUN</p>
                </div>
                <div class="langkah-card">
                    <div class="langkah-number">4</div>
                    <h4 class="langkah-title">Konfirmasi dan Dapatkan Kode</h4>
                    <p class="langkah-description">Selesaikan registrasi dan dapatkan kode unik untuk check-in</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang PTUN Section -->
    <section id="tentang" class="tentang-section">
        <div class="container">
            <div class="tentang-wrapper">
                <div class="tentang-content">
                    <h2 class="tentang-title">Tentang PTUN Bandung</h2>
                    <p class="tentang-subtitle">Peradilan Tata Usaha Negara Pengadilan Tinggi Bandung</p>
                    
                    <div class="tentang-text">
                        <p>Pengadilan Tata Usaha Negara (PTUN) Bandung adalah lembaga peradilan yang memiliki kewenangan mengadili sengketa tata usaha negara di wilayah kerja Pengadilan Tinggi Tata Usaha Negara Bandung.</p>
                        
                        <p style="margin-top: 1.5rem;">Dengan semangat "Tegak di Atas Hukum, Adil bagi Rakyat", PTUN Bandung berkomitmen memberikan pelayanan terbaik kepada semua pihak yang datang meminta perlindungan hukum mereka.</p>
                        
                        <p style="margin-top: 1.5rem;">Sistem Buku Tamu Digital ini merupakan salah satu wujud nyata komitmen PTUN Bandung dalam meningkatkan kualitas pelayanan dan menerapkan teknologi informasi untuk kemudahan akses publik.</p>
                    </div>

                    <div class="tentang-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-gavel"></i>
                            <span>Pelayanan Hukum Profesional</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-users"></i>
                            <span>Akses Publik Terbuka</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-globe"></i>
                            <span>Transformasi Digital</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-wrapper">
                <h2 class="cta-title">Siap untuk Berkunjung?</h2>
                <p class="cta-subtitle">Daftar kunjungan Anda sekarang melalui sistem Buku Tamu Digital</p>
                <a href="{{ route('home') }}" class="nav-link btn btn-primary btn-large">
                    Mulai Pendaftaran
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4 class="footer-title">Buku Tamu Digital</h4>
                    <p class="footer-text">Sistem pencatatan kunjungan modern untuk PTUN Bandung</p>
                </div>
                <div class="footer-section">
                    <h4 class="footer-title">Tautan Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#cara">Cara Menggunakan</a></li>
                        <li><a href="#tentang">Tentang PTUN</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4 class="footer-title">Kontak</h4>
                    <p class="footer-text">PTUN Bandung<br>Jl. Ahmad Yani No. 2, Bandung</p>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2025 Sistem Buku Tamu Digital PTUN Bandung. Semua hak dilindungi.</p>
                <div class="footer-social">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

         {{-- JavaScript Dependencies --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

        <script>
            // Intro Animation Handler
            document.addEventListener('DOMContentLoaded', function() {
                const overlay = document.querySelector('.intro-overlay');
                const form = document.querySelector('.form-container');
                const introButton = document.querySelector('.intro-button');

                // Hanya jalankan jika overlay ada (tidak dalam kondisi success)
                if (overlay && introButton) {
                    introButton.addEventListener('click', function() {
                        overlay.classList.add('fade-out');
                        form.classList.add('visible');
                        form.classList.remove('hidden-form');
                        
                        setTimeout(() => {
                            overlay.style.display = 'none';
                        }, 500);
                    });
                }
            });

            // Inisialisasi smooth scroll untuk anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>

    </footer>
</body>
</html>
