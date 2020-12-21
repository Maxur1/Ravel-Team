<?php

namespace App\Mail;

use App\Situation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SituationMail extends Mailable
{
    use Queueable, SerializesModels;


    public $usuario;
    public $situacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Situation $situacion, $usuario)
    {
        $this->situacion = $situacion;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.avance_registrado');
    }
}
