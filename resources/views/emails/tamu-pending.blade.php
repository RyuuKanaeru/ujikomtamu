<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Kunjungan Sedang Diproses</title>
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
            background: linear-gradient(135deg, #ffc107 0%, #ffb700 100%);
            color: #333;
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
            background-color: #fff3cd;
            color: #856404;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .details {
            background-color: #f8f9fa;
            border-left: 4px solid #ffc107;
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
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #856404;
            line-height: 1.6;
        }
        .timeline {
            background-color: #e7f3ff;
            border-left: 4px solid #0066cc;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #004085;
            line-height: 1.8;
        }
        .timeline-item {
            margin-bottom: 10px;
        }
        .timeline-item strong {
            display: block;
            color: #003d99;
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
            color: #ffc107;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>⏳ Permintaan Sedang Diproses</h1>
            <p>Pengadilan Tinggi Agama (PTUN) Bandung</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Assalamu'alaikum,<br>
                Halo <strong>{{ $bukuTamu->nama }}</strong>
            </div>

            <div class="status-badge">
                ⏳ Status: Sedang Diproses
            </div>

            <p style="color: #2d3748; font-size: 15px; line-height: 1.6;">
                Terima kasih telah mengajukan permintaan kunjungan ke Pengadilan Tinggi Agama (PTUN) Bandung. 
                Permintaan Anda saat ini <strong>sedang kami proses dan verifikasi</strong>. 
                Kami akan memberikan kepastian dalam waktu singkat.
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
                    <span class="detail-label">Waktu Datang:</span>
                    <span class="detail-value">{{ $bukuTamu->waktu_datang->format('d-m-Y') }}</span>
                </div>
            </div>

            <div class="message">
                <strong>Informasi Penting:</strong><br>
                Data Anda telah diterima oleh sistem kami. Tim administrasi kami akan melakukan verifikasi dan 
                akan menghubungi Anda dalam waktu 1-3 hari kerja melalui email ini untuk memberikan keputusan akhir.
            </div>

            <div class="timeline">
                <strong>📋 Proses Verifikasi:</strong>
                <div class="timeline-item">
                    <strong>✓ Data diterima</strong>
                    Permintaan Anda telah masuk ke sistem (sekarang)
                </div>
                <div class="timeline-item">
                    <strong>⏳ Verifikasi data</strong>
                    Tim kami sedang memeriksa kelengkapan data Anda
                </div>
                <div class="timeline-item">
                    <strong>📞 Konfirmasi</strong>
                    Kami akan memberitahu keputusan dalam 1-3 hari kerja
                </div>
            </div>

            <p style="color: #555; font-size: 14px; line-height: 1.6;">
                Jika ada data yang kurang lengkap atau ada pertanyaan, 
                kami akan segera menghubungi Anda melalui email atau nomor telepon yang terdaftar.
            </p>

            <p style="color: #555; font-size: 14px; line-height: 1.6; margin-top: 20px;">
                Terima kasih atas kesabaran Anda. Kami berkomitmen untuk memberikan pelayanan terbaik.
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
