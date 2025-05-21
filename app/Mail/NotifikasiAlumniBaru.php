<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Alumni;

class NotifikasiAlumniBaru extends Mailable
{
    use Queueable, SerializesModels;

    public $alumni;

    public function __construct(Alumni $alumni)
    {
        $this->alumni = $alumni;
    }

    public function build()
    {
        return $this->subject('Pendaftaran Alumni Baru - Perlu Verifikasi')
                    ->view('emails.notifikasi_alumni_baru');
    }
}
