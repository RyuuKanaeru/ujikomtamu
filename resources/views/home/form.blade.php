@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('HomeCss/form.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Animasi untuk overlay setelah submit */
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Animasi untuk alert sukses */
        .swal2-popup {
            padding: 2em !important;
            border-radius: 20px !important;
            background: linear-gradient(145deg, #ffffff, #f0f0f0) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 141, 0, 0.25) !important;
        }

        .swal2-title {
            font-size: 2em !important;
            background: linear-gradient(45deg, #008D00, #00b82e) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            font-weight: 700 !important;
            padding: 0.5em 0 !important;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)) !important;
        }

        .success-message {
            position: relative;
            background: #f0fff4;
            border: 2px solid #008D00;
            border-radius: 15px;
            padding: 2em;
            margin: 1em 0;
            overflow: hidden;
            transform: translateZ(0);
        }

        .success-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #008D00, #00b82e, #008D00);
            animation: loading 2s linear infinite;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .countdown {
            margin-top: 1em;
            padding: 0.5em;
            background: rgba(0, 141, 0, 0.1);
            border-radius: 8px;
            font-weight: 500;
        }

        /* Animasi fade out custom */
        @keyframes customFadeOut {
            0% { 
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            100% { 
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }
        }

        .fade-out-custom {
            animation: customFadeOut 0.8s ease forwards;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid form-container {{ !session('success') ? 'hidden-form' : 'visible' }}">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">


                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Form Buku Tamu</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tamu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Main Layout: Camera (Left) + Form (Right) -->
                            <div class="form-layout-container">
                                
                                <!-- Camera Section (Left) -->
                                <div class="camera-section">
                                    <div class="camera-wrapper">
                                        <div class="camera-title">
                                            <i class="fas fa-camera"></i> Foto Wajah
                                        </div>
                                        
                                        <!-- Circular Camera Container with Plus Icon -->
                                        <div class="video-container" id="videoContainer">
                                            <!-- Plus Icon (shows when camera not active) -->
                                            <button type="button" class="camera-plus-btn" id="cameraToggleBtn" title="Aktifkan Kamera">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            
                                            <!-- Video element (hidden by default) -->
                                            <video id="video" playsinline></video>
                                            <canvas id="canvas" width="320" height="320" style="display:none;"></canvas>
                                            
                                            <!-- Photo Preview -->
                                            <div id="photoPreview" class="photo-preview d-none">
                                                <img id="photoResult" src="#" alt="Preview">
                                            </div>
                                            
                                            <!-- Close button (appears when camera active) -->
                                            <button type="button" class="camera-close-btn" id="closeCameraBtn" title="Tutup Kamera" style="display:none;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <!-- Capture Button (appears when camera is active) -->
                                        <div class="camera-capture-section">
                                            <button type="button" class="btn-capture" id="captureBtn" style="display:none;">
                                                <i class="fas fa-camera"></i> Ambil Foto
                                            </button>
                                        </div>

                                        <!-- Photo Actions (appears after photo captured) -->
                                        <div class="photo-actions" id="photoActions" style="display:none;">
                                            <button type="button" class="btn-action btn-retake" id="retakeBtn">
                                                <i class="fas fa-redo"></i> Ulang
                                            </button>
                                            <button type="button" class="btn-action btn-accept" id="acceptBtn">
                                                <i class="fas fa-check"></i> Gunakan
                                            </button>
                                        </div>

                                        <input type="hidden" name="foto_wajah" id="foto_wajah_hidden">
                                        @error('foto_wajah')
                                            <div class="invalid-feedback d-block mt-3" style="text-align: center;">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Section (Right) -->
                                <div class="form-section">
                                    
                                    <!-- Nama -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                            id="nama" name="nama" value="{{ old('nama') }}" required
                                            placeholder="Masukkan nama lengkap">
                                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                                            id="alamat" name="alamat" value="{{ old('alamat') }}" required
                                            placeholder="Masukkan alamat lengkap">
                                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- No Telepon -->
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" 
                                            id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                            placeholder="Masukkan nomor telepon">
                                        <label for="no_telepon">Nomor Telepon</label>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Keperluan -->
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control @error('keperluan') is-invalid @enderror" 
                                            id="keperluan" name="keperluan" style="height: 100px" required
                                            placeholder="Masukkan keperluan">{{ old('keperluan') }}</textarea>
                                        <label for="keperluan">Keperluan <span class="text-danger">*</span></label>
                                        @error('keperluan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Waktu Datang -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('waktu_datang') is-invalid @enderror" 
                                            id="waktu_datang" name="waktu_datang" 
                                            value="{{ old('waktu_datang', now()->format('Y-m-d')) }}" required readonly>
                                        <label for="waktu_datang">Waktu Datang <span class="text-danger">*</span></label>
                                        @error('waktu_datang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Submit (Center Bottom) -->
                            <div class="submit-buttons-section">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript Dependencies --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <script>
        // ============================================
        // CAMERA FUNCTIONALITY - NEW DESIGN
        // ============================================

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const videoContainer = document.getElementById('videoContainer');
        const cameraToggleBtn = document.getElementById('cameraToggleBtn');
        const captureBtn = document.getElementById('captureBtn');
        const closeCameraBtn = document.getElementById('closeCameraBtn');
        const photoPreview = document.getElementById('photoPreview');
        const photoResult = document.getElementById('photoResult');
        const photoActions = document.getElementById('photoActions');
        const retakeBtn = document.getElementById('retakeBtn');
        const acceptBtn = document.getElementById('acceptBtn');
        const fotoWajahHidden = document.getElementById('foto_wajah_hidden');

        let cameraStream = null;
        let currentPhotoData = null;

        // Open camera when clicking plus icon
        cameraToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openCamera();
        });

        // Close camera button
        closeCameraBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeCamera();
        });

        // Capture photo
        captureBtn.addEventListener('click', function(e) {
            e.preventDefault();
            takePhoto();
        });

        // Retake photo
        retakeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            resetCamera();
        });

        // Accept photo
        acceptBtn.addEventListener('click', function(e) {
            e.preventDefault();
            confirmPhoto();
        });

        function openCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                })
                    .then(function(stream) {
                        cameraStream = stream;
                        video.srcObject = stream;
                        video.style.display = 'block';
                        video.play();
                        
                        cameraToggleBtn.style.display = 'none';
                        captureBtn.style.display = 'flex';
                        closeCameraBtn.style.display = 'flex';
                    })
                    .catch(function(err) {
                        alert('Tidak dapat mengakses kamera: ' + err.message);
                    });
            } else {
                alert('Browser tidak mendukung akses kamera.');
            }
        }

        function closeCamera() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            closeCameraBtn.style.display = 'none';
            photoActions.style.display = 'none';
            cameraToggleBtn.style.display = 'flex';
        }

        function takePhoto() {
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = video.videoWidth;
            tempCanvas.height = video.videoHeight;
            const tempCtx = tempCanvas.getContext('2d');
            
            // Flip horizontal
            tempCtx.translate(tempCanvas.width, 0);
            tempCtx.scale(-1, 1);
            tempCtx.drawImage(video, 0, 0);
            tempCtx.setTransform(1, 0, 0, 1, 0, 0);

            // Compress to JPEG
            let quality = 0.7;
            let dataUrl = tempCanvas.toDataURL('image/jpeg', quality);

            function getSizeInKB(base64) {
                const head = 'data:image/jpeg;base64,';
                return Math.round((base64.length - head.length) * 3/4 / 1024);
            }
            
            let size = getSizeInKB(dataUrl);
            while ((size > 150 || size < 50) && (quality > 0.4 && quality < 0.9)) {
                if (size > 150) quality -= 0.05;
                else if (size < 50) quality += 0.05;
                dataUrl = tempCanvas.toDataURL('image/jpeg', quality);
                size = getSizeInKB(dataUrl);
            }

            currentPhotoData = dataUrl;
            photoResult.src = dataUrl;
            photoPreview.classList.remove('d-none');
            
            // Hide camera, show photo actions
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            closeCameraBtn.style.display = 'none';
            photoActions.style.display = 'flex';
        }

        function resetCamera() {
            photoPreview.classList.add('d-none');
            photoResult.src = '#';
            currentPhotoData = null;
            photoActions.style.display = 'none';
            
            // Show video again
            video.style.display = 'block';
            captureBtn.style.display = 'flex';
            closeCameraBtn.style.display = 'flex';
        }

        function confirmPhoto() {
            if (currentPhotoData) {
                fotoWajahHidden.value = currentPhotoData;
                closeCamera();
                // Keep photo preview visible
                video.style.display = 'none';
                photoPreview.classList.remove('d-none');
                photoActions.style.display = 'none';
                cameraToggleBtn.style.display = 'none';
            }
        }

        // Inisialisasi Flatpickr untuk input tanggal
        flatpickr("#waktu_datang", {
            dateFormat: "Y-m-d",
            allowInput: true,
            disableMobile: true
        });


         @if(session('success'))
            let timerInterval;
            Swal.fire({
                title: 'Berhasil!',
                html: `
                    <div style="margin-bottom: 10px;">
                        <i class="fas fa-check-circle" 
                            style="color: #008D00; font-size: 3.5em;"></i>
                    </div>
                    <h3 style="color: #008D00; font-size: 1.3em; font-weight: 600;">
                        Data Berhasil Disimpan
                    </h3>
                    <p style="color: #2f855a; margin-top: 5px; font-size: 1em;">
                        Terima kasih atas kunjungan Anda di PTUN Bandung
                    </p>
                    <div class="countdown">
                        Mengarahkan ke halaman about dalam 
                        <b style="color:#008D00"></b>
                    </div>
                `,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,

                // Efek MUNCUL minimalis
                showClass: {
                    popup: `
                        animate__animated 
                        animate__fadeIn 
                        animate__faster
                    `
                },

                // Efek hilang normal (nanti fade-out halaman tetap jalan)
                hideClass: {
                    popup: `
                        animate__animated 
                        animate__fadeOut 
                        animate__faster
                    `
                },

                background: 'rgba(255,255,255,0.95)',
                backdrop: `
                    rgba(0,0,0,0.15)
                    blur(2px)
                `,

                didOpen: (toast) => {
                    const b = toast.querySelector('b');
                    timerInterval = setInterval(() => {
                        b.textContent = Math.ceil(Swal.getTimerLeft() / 1000) + ' detik';
                    }, 100);
                },

                willClose: () => clearInterval(timerInterval)
            }).then(function() {

                // FADE OUT HALAMAN — INI TETAP DIPERTAHANKAN
                const fadeOut = document.createElement('style');
                fadeOut.textContent = `
                    @keyframes customFadeOut {
                        from { opacity: 1; transform: scale(1); }
                        to { opacity: 0; transform: scale(0.95); }
                    }
                    body {
                        animation: customFadeOut 0.8s ease forwards !important;
                    }
                `;
                document.head.appendChild(fadeOut);

                setTimeout(() => {
                    window.location.href = '{{ route('about') }}';
                }, 800);
            });
        @endif





    // Inisialisasi Flatpickr untuk input tanggal
    flatpickr("#waktu_datang", {
        dateFormat: "Y-m-d",
        allowInput: true,
        disableMobile: true
    });
    </script>
@endsection
