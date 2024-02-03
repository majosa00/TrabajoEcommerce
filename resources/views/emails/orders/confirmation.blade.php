@component('mail::message')
# Gracias por tu compra en EnergeticWave

Aquí los detalles de tu pedido:

@foreach ($order->products as $product)
- **Producto:** {{ $product->name }}
  **Cantidad:** {{ $product->pivot->amount }}
  **Precio:** ${{ number_format($product->price, 2) }}
@endforeach

**Precio Total:** ${{ number_format($order->totalPrice, 2) }}

![Icono de EnergeticWave]({{ $logoUrl }})

Gracias por confiar en EnergeticWave. ¡Esperamos que disfrutes de tus productos!

Saludos,
{{ config('app.name') }}
@endcomponent
