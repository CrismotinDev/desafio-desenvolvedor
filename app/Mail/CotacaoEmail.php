<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CotacaoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $valorMoedaDestino;
    public $valorTotalMoedaDestino;
    public $taxaPagamento;
    public $taxaConversao;
    public $valorUtilizadoDescontandoTaxas;

    public function __construct($valorMoedaDestino, $valorTotalMoedaDestino, $taxaPagamento, $taxaConversao, $valorUtilizadoDescontandoTaxas)
    {
        $this->valorMoedaDestino = $valorMoedaDestino;
        $this->valorTotalMoedaDestino = $valorTotalMoedaDestino;
        $this->taxaPagamento = $taxaPagamento;
        $this->taxaConversao = $taxaConversao;
        $this->valorUtilizadoDescontandoTaxas = $valorUtilizadoDescontandoTaxas;
    }

    public function build()
    {
        return $this->view('emails.cotacao');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cotacao Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
}
