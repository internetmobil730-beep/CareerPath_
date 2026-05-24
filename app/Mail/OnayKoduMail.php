<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

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

    // الاعتماد على دالّة build التقليدية والأكثر استقراراً في السيرفرات المشتركة
    public function build()
    {
        return $this->html("<h3>CareerPath Sistemine Hoş Geldiniz</h3><p>Giriş yapmak için onay kodunuz: <b>{$this->code}</b></p>");
    }
}