<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notificacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
 
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('fcyt_sistemas@uader.edu.ar','Departamento de Sistemas FCYT - UADER')
            ->subject('Cambios Realizados')
            ->greeting('¡Hola!')
            ->salutation('¡Muchas gracias!')
            ->line('Enviamos este email porque notamos que se han realizado cambios en su cuenta.')
            ->line('Si Ud. no realizó ningún cambio, por favor informar.');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificacion');
    }
}