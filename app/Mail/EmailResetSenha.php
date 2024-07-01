<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailResetSenha extends Mailable
{
    use Queueable, SerializesModels;

    public $config;
    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nomeUsuario, string $hash)
    {
        $this->config = [
            'base_url' => env("APP_URL")
        ];

        $this->details = [
            "nome" => $nomeUsuario,
            "codigo_confirmacao" => $hash,
            "url_confirmacao" => $this->config['base_url'] . "/auth/redefinir-senha/" . $hash
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Redefinição de senha',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email-redefinir-senha',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Recuperação de Senha')
                    ->view('emails.email-redefinir-senha');
    }
}
