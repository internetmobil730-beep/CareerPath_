<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class OnayKoduMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CareerPath Giriş Onay Kodu',
        );
    }

    public function content(): Content
    {
        // استخدام الطريقة الحديثة المتوافقة 100% مع الـ Envelope لمنع خطأ 500
        return new Content(
            htmlString: "<h3>CareerPath Sistemine Hoş Geldiniz</h3><p>Giriş yapmak için onay kodunuz: <b style='font-size:18px; color:#007bff;'>{$this->code}</b></p>",
        );
    }

    public function attachments(): array
    {
        return [];
    }
}