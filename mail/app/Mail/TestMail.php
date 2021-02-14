<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $text;

    public function __construct($nonopt, $text = null) //inizializziamo text come stringa vuota, lo facciamo se non abbiamo parametri di ingresso nel "-> send(new TestMail());" all'interno del controller, se volessi inserire una seconda variabile dovrei metterla prima di $text = null a sinistra
    {
        $this -> text = $text;
    }
    public function build()
    {
        return $this
        ->from('no-reply@boolean.careers')
        ->view('auth.mail.testMail');
    }
}
