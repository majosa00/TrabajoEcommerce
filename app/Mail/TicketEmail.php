<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $logoUrl;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        // Asegúrate de reemplazar 'url_publica_de_la_imagen' con la URL real de tu imagen
        $this->logoUrl = asset('images/energeticwave-logo.png');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Si estás generando un ticket en formato PDF, utiliza una vista diferente
        if (request()->routeIs('cart.generateTicket')) {
            // Asegúrate de tener una vista llamada 'pdf.ticket' o ajusta el nombre según tu estructura
            return $this->view('pdf.ticket');
        }

        // Si no estás generando un ticket, utiliza la vista de confirmación por defecto
        return $this->markdown('emails.orders.confirmation')
            ->subject('Order Confirmation');
    }
}
