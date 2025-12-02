<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Kunjungan Diterima</title>
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
            background: linear-gradient(135deg, #008D00 0%, #00db37 100%);
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
            background-color: #d4edda;
            color: #155724;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .details {
            background-color: #f8f9fa;
            border-left: 4px solid #008D00;
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
        .cta-button {
            display: inline-block;
            background-color: #008D00;
            color: white;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }
        .cta-button:hover {
            background-color: #005c00;
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
            color: #008D00;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✓ Permintaan Diterima</h1>
            <p>Pengadilan Tinggi Agama (PTUN) Bandung</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Assalamu'alaikum,<br>
                Halo <strong>{{ $bukuTamu->nama }}</strong>
            </div>

            <div class="status-badge">
                ✓ Status: Diterima
            </div>

            <p style="color: #2d3748; font-size: 15px; line-height: 1.6;">
                Kami dengan senang hati menginformasikan bahwa permintaan kunjungan Anda telah <strong>diterima dan disetujui</strong>. 
                Anda dapat melanjutkan kunjungan sesuai dengan jadwal yang telah ditentukan.
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
                Silakan datang ke PTUN Bandung sesuai dengan jadwal yang tertera di atas. 
                Jika ada perubahan jadwal, mohon hubungi kami terlebih dahulu melalui kontak yang tersedia.
            </div>

            <!-- CTA Button -->
            <p style="text-align: center;">
                <a href="{{ config('app.url') }}" class="cta-button">Kunjungi Website</a>
            </p>

            <p style="color: #555; font-size: 14px; line-height: 1.6;">
                Terima kasih atas kunjungan Anda ke Pengadilan Tinggi Agama (PTUN) Bandung.
                Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.
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
