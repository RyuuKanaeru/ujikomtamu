<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Kunjungan Ditolak</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .greeting {
            font-size: 16px;
            color: #2d3748;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .status-badge {
            display: inline-block;
            background-color: #f8d7da;
            color: #721c24;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .details {
            background-color: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .detail-label {
            font-weight: 600;
            color: #2d3748;
            width: 120px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #555;
            flex: 1;
        }
        .message {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #721c24;
            line-height: 1.6;
        }
        .contact-info {
            background-color: #e7f3ff;
            border-left: 4px solid #0066cc;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #004085;
            line-height: 1.6;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .footer a {
            color: #dc3545;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✕ Permintaan Ditolak</h1>
            <p>Pengadilan Tinggi Agama (PTUN) Bandung</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Assalamu'alaikum,<br>
                Halo <strong>{{ $bukuTamu->nama }}</strong>
            </div>

            <div class="status-badge">
                ✕ Status: Ditolak
            </div>

            <p style="color: #2d3748; font-size: 15px; line-height: 1.6;">
                Kami menyampaikan dengan penuh pertimbangan bahwa permintaan kunjungan Anda <strong>tidak dapat disetujui</strong> 
                pada saat ini. Keputusan ini diambil berdasarkan pertimbangan administratif dan ketentuan yang berlaku.
            </p>

            <!-- Details -->
            <div class="details">
                <div class="detail-row">
                    <span class="detail-label">Nama Lengkap:</span>
                    <span class="detail-value">{{ $bukuTamu->nama }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $bukuTamu->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Keperluan:</span>
                    <span class="detail-value">{{ $bukuTamu->keperluan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Waktu Datang yang Diminta:</span>
                    <span class="detail-value">{{ $bukuTamu->waktu_datang->format('d-m-Y') }}</span>
                </div>
            </div>

            <div class="message">
                <strong>Pemberitahuan:</strong><br>
                Jika Anda merasa ada kesalahpahaman dalam keputusan ini atau ingin melakukan upaya banding, 
                silakan hubungi kami untuk mendapatkan penjelasan lebih lanjut.
            </div>

            <div class="contact-info">
                <strong>Hubungi Kami:</strong><br>
                Jika ada pertanyaan atau ingin mendiskusikan lebih lanjut, 
                silakan menghubungi bagian administrasi PTUN Bandung melalui kontak resmi yang tersedia.
            </div>

            <p style="color: #555; font-size: 14px; line-height: 1.6;">
                Terima kasih atas pengertian Anda. Kami menghargai minat Anda untuk berkunjung ke 
                Pengadilan Tinggi Agama (PTUN) Bandung.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 10px 0;">
                &copy; {{ date('Y') }} Pengadilan Tinggi Agama (PTUN) Bandung. Semua hak dilindungi.
            </p>
            <p style="margin: 0;">
                Email ini dikirim secara otomatis. Jangan balas email ini.
            </p>
        </div>
    </div>
</body>
</html>
