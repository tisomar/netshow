<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contato;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $contato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contato $contato)
    {
        $this->contato = $contato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $mail_from = \config('mail.from.address');
        $mail_to = \config('mail.to.address');
        $this->subject('Dados do Contato');
        $this->to($mail_to, 'NetShow');
        $this->from($mail_from, 'Teste Netshow');

        return $this->markdown('mail.contato',[
            'contato' => $this->contato
        ]);
    }
}
