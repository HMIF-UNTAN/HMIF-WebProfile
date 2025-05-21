<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Alumni;

class AlumniTerverifikasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $alumni;

    public function __construct(Alumni $alumni)
    {
        $this->alumni = $alumni;
    }

    public function build()
    {
        return $this->subject('Verifikasi Alumni Informatika FT UNTAN')
                    ->view('emails.alumni_terverifikasi');
    }
}
