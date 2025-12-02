<?php

namespace App\Mail;

use App\Models\BukuTamu;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TamuPendingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BukuTamu $bukuTamu) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'firdausryan.aa@gmail.com',
            to: $this->bukuTamu->email,
            subject: 'Permintaan Kunjungan Anda Sedang Diproses - PTUN Bandung',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.tamu-pending',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
