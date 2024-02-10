@component('mail::message')
    # Thank you for your purchase at EnergeticWave

    Here are the details of your order:

    @foreach ($order->products as $product)
        {{-- - **Product:** {{ $product->name }} --}}
        **Quantity:** {{ $product->pivot->amount }}
        **Price:** ${{ number_format($product->price, 2) }}
    @endforeach

    **Shipping Address:** @if ($order->address)
        {{ $order->address }}
    @else
        No shipping address provided
    @endif

    **Total Price:** ${{ number_format($order->totalPrice, 2) }}

    ![EnergeticWave Icon]({{ $logoUrl }})

    Thank you for choosing EnergeticWave. We hope you enjoy your products!

    Regards,
    {{ config('app.name') }}
@endcomponent
