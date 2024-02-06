{{-- resources/views/products/cart.blade.php --}}
@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">CART</h1>
        @foreach ($products as $product)
            <div class="row">
                <div class="col-lg-4">
                    <img>
                </div>
                <div class="col-lg-4">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->pivot->amount }}</p>
                </div>
                <div class="col-lg-4">
                    <h3>{{ $product->price }} $</h3>
                    <h3>Total Price:
                        {{ $products->sum(function ($product) {
                            return $product->price * $product->pivot->amount;
                        }) }}
                        $
                    </h3>
                </div>
            </div>
            <td>
                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
        </table>

        
        <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-warning btn-sm" type="submit">Payment</button>
        </form>
    </div>
@endsection
