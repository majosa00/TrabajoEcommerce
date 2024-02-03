@component('mail::message')
# Order Confirmation

Thank you for your purchase!

Here are the details of your order:

@foreach ($order->products as $product)
- {{ $product->name }} x{{ $product->pivot->amount }}: ${{ $product->price }}
@endforeach

**Total Price:** ${{ $order->totalPrice }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent