<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('AdminCss/layout.css') }}">
</head>
<body>
    <div id="wrapper">
                <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar">
                <div class="sidebar-brand">
                    <img src="{{ asset('ImageHome/logoptun-removebg-preview.png') }}" alt="PTUN Logo">
                    <p>Pengadilan Tata Usaha Negara Bandung </p>
                </div>
                <div class="flex-grow-1">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/accept') ? 'active' : '' }}" href="{{ route('tamu.accept.page') }}">
                                <i class="fas fa-check-circle"></i>
                                Accept
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/pending') ? 'active' : '' }}" href="{{ route('tamu.pending.page') }}">
                                <i class="fas fa-hourglass-half"></i>
                                Pending
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/reject') ? 'active' : '' }}" href="{{ route('tamu.reject.page') }}">
                                <i class="fas fa-times-circle"></i>
                                Reject
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/statistik') ? 'active' : '' }}" href="{{ route('admin.statistik') }}">
                                <i class="fas fa-chart-bar"></i>
                                Statistik Tamu
                            </a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/tamu-lama') ? 'active' : '' }}" href="{{ route('admin.tamu.lama') }}">
        <i class="fas fa-history"></i>
        Reset Tamu Lama
    </a>
</li>

                        <!-- Menu Laporan Harian dan Pengaturan dihapus sesuai permintaan -->
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form action="{{ route('admin.logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="button" id="logoutBtn" class="btn btn-logout w-100">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container-fluid">
                    <button id="menu-toggle" class="me-2">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-book me-2"></i> Buku Tamu
                    </a>
                </div>
            </nav>

            <div class="container-fluid" style="padding-top: 4.5rem;">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const wrapper = document.getElementById("wrapper");

        function openSidebar() {
            wrapper.classList.add("toggled");
            document.body.classList.add("sidebar-shown");
        }
        function closeSidebar() {
            wrapper.classList.remove("toggled");
            document.body.classList.remove("sidebar-shown");
        }

        menuToggle.addEventListener("click", function(e) {
            e.preventDefault();
            if (wrapper.classList.contains("toggled")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        // Optional: close sidebar on resize if desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        // SweetAlert konfirmasi logout admin
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin ingin logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutBtn.closest('form').submit();
                    }
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
