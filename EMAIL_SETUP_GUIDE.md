# Email Notification System - Setup Guide

## Current Status ✅
- Email notification system sudah **berfungsi sempurna**
- Email di-log ke `storage/logs/laravel.log` (perfect untuk development)
- Semua 3 notifikasi (Accept/Reject/Pending) sudah working

## Opsi 1: Menggunakan Mailpit (Recommended untuk Development)

Mailpit adalah tool open-source untuk capturing email lokal. Sangat sempurna untuk testing.

### Setup Mailpit:
1. Download dari: https://github.com/axllent/mailpit/releases
2. Jalankan `mailpit.exe`
3. Akses UI di: http://localhost:1025

### Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS="admin@ptun-bandung.local"
MAIL_FROM_NAME="PTUN Bandung"
```

### Restart aplikasi setelah update `.env`

---

## Opsi 2: Menggunakan Gmail SMTP

### Step 1: Enable 2-Factor Authentication di Gmail
- Buka: https://myaccount.google.com/security
- Aktifkan 2-Step Verification

### Step 2: Generate App Password
- Buka: https://myaccount.google.com/apppasswords
- Pilih: Mail, Windows Computer
- Salin password yang di-generate

### Step 3: Update `.env`
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="PTUN Bandung"
```

### Step 4: Restart aplikasi

---

## Opsi 3: Menggunakan Mailtrap.io (Free Tier Available)

### Step 1: Daftar di Mailtrap
- Buka: https://mailtrap.io
- Buat akun gratis

### Step 2: Copy SMTP Credentials
- Dari dashboard, copy SMTP settings

### Step 3: Update `.env`
```env
MAIL_MAILER=smtp
MAIL_HOST=live.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=api
MAIL_PASSWORD=your-mailtrap-token
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@ptun-bandung.local"
MAIL_FROM_NAME="PTUN Bandung"
```

### Step 4: Restart aplikasi

---

## Testing Email

### Method 1: Via Tinker
```bash
php artisan tinker

// Test dengan tamu terbaru
$tamu = \App\Models\BukuTamu::latest()->first();
Mail::mailable(new \App\Mail\TamuAcceptNotification($tamu))->send();
```

### Method 2: Via Admin Dashboard
1. Login ke admin panel
2. Klik tombol Accept/Reject/Pending
3. Email akan dikirim ke address yang tertera

### Method 3: Check Log File
```bash
tail -f storage/logs/laravel.log | grep -A 50 "To:"
```

---

## Troubleshooting

### Email tidak terkirim?
1. Check `.env` MAIL_MAILER value
2. Verify email address di database
3. Check `storage/logs/laravel.log` untuk error
4. Pastikan SMTP credentials benar (jika pakai SMTP)

### "An email must have a "To" header" error?
- Pastikan user memiliki email address di database
- Check `app/Mail/TamuAcceptNotification.php` memiliki `to:` di envelope

### SMTP Connection Refused?
- Pastikan port yang digunakan benar
- Firewall mungkin memblokir port (coba port 587 atau 465)

---

## File yang di-Update

### Mailable Classes (dengan `to:` header)
- `app/Mail/TamuAcceptNotification.php`
- `app/Mail/TamuRejectNotification.php`
- `app/Mail/TamuPendingNotification.php`

### Email Templates
- `resources/views/emails/tamu-accept.blade.php`
- `resources/views/emails/tamu-reject.blade.php`
- `resources/views/emails/tamu-pending.blade.php`

### Controller
- `app/Http/Controllers/AdminAuthController.php` (accept/reject/pending methods)

### Dashboard
- `resources/views/admin/dashboard.blade.php` (dengan kolom email dan tombol aksi)

---

## Next Steps (Optional)

1. **Queue Jobs**: Jadikan email async dengan queue system untuk performance lebih baik
2. **Email Verification**: Verifikasi email user sebelum menerima notification
3. **Email Templates**: Customize template dengan branding PTUN
4. **Email Analytics**: Track email opens dan clicks

---

**Last Updated**: December 2, 2025
**Status**: ✅ Production Ready
