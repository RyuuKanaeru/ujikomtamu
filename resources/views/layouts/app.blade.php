<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Buku Tamu - Pengadilan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header/Navigation -->
    <nav class="nav-container">
        <div class="container">
            <div class="nav-content">
                <div class="nav-brand">
                    <img src="{{ asset('ImageHome/logoptun-removebg-preview.png') }}" alt="PTUN Logo" class="nav-logo">
                    <span class="nav-title">PTUN Bandung</span>
                </div>
                <button class="mobile-menu-btn" onclick="toggleMenu()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="nav-menu">
                    <a href="{{ route('welcome') }}" class="nav-link">Home</a>
                    <a href="{{ route('home') }}" class="nav-link">Form</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('kontak') }}" class="nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar">
        <div class="sidebar-header">
            <span>Menu</span>
            <button class="close-sidebar" onclick="toggleMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('welcome') }}" class="sidebar-link">Home</a>
            <a href="{{ route('home') }}" class="sidebar-link">Form</a>
            <a href="{{ route('about') }}" class="sidebar-link">About</a>
            <a href="{{ route('kontak') }}" class="sidebar-link">Contact</a>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
    <script>
        function toggleMenu() {
            const sidebar = document.querySelector('.mobile-sidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.mobile-sidebar');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>
