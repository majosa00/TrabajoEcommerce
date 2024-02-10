<?php

// App\Http\Controllers\CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation; // Asegúrate de haber creado esta Mailable

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Obtener el usuario autenticado actualmente
        $user = Auth::user();
        // Buscar en la base de datos el ID del producto
        $product = Product::find($productId);

        if (!$product) { // Si no lo encuentra, vuelve a la página anterior con un mensaje de error
            return back()->with('error', 'Product not found.');
        }

        // Busca el carrito asociado al usuario, si no existe lo crea
        $cart = $user->cart ?? new Cart(['user_id' => $user->id]);
        $cart->save();

        // Verificar si el producto ya está en el carrito
        if ($cart->products()->where('product_id', $productId)->exists()) {
            // Obtener el registro pivot para ese producto
            $pivot = $cart->products()->where('product_id', $productId)->first()->pivot;
            // Incrementar la cantidad en 1
            $pivot->amount += 1;
            $pivot->save();
        } else {
            // Asocia el carrito al producto del usuario con una cantidad de 1 si el producto no está en el carrito
            $cart->products()->attach($productId, ['amount' => 1]);
        }

        // Si funciona, redirige a la página anterior con un mensaje de éxito indicando que el producto fue añadido al carrito
        return redirect()->route('cart.view')->with('success', 'Product added to the cart.');
    }

    public function viewCart()
    {
        //Obtener el usuario autenticado actualmente
        $user = Auth::user();

        //Obtener carrito del usuario
        $cart = $user->cart;

        //Obtener productos del carrito y la cantidad
        if ($cart) {
            $products = $cart->products()->withPivot('amount')->get();
        } else {
            $products = collect();
        }

        return view('products.cart', compact('products'));
    }

    public function pay(Request $request)
    {
        // Obtener el usuario autenticado actualmente
        $user = Auth::user();

        // Obtener carrito del usuario
        $cart = $user->cart;

        // Crear nuevo pedido
        $order = new Order();
        $order->user_id = $user->id;

        // Completar campos del pedido
        $order->state = 'Pending'; // Los pedidos estarán en pendiente de inicio
        $order->orderDate = now();
        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->amount;
        });
        $order->totalPrice = $totalPrice;

        if ($request->filled('address')) {
            $selectedAddressId = $request->input('address');
            $selectedAddress = Address::find($selectedAddressId);

            if ($selectedAddress) {
                // Crear un array con los detalles de la dirección seleccionada
                $addressDetails = [
                    'address' => $selectedAddress->address,
                    'city' => $selectedAddress->city,
                    'country' => $selectedAddress->country,
                    'zipcode' => $selectedAddress->zipCode,
                ];

                // Convertir los detalles de la dirección en una cadena
                $formattedAddress = implode(', ', $addressDetails);
                // Guardar la dirección en la base de datos o realizar acciones adicionales según tus necesidades
                $order->address = $formattedAddress;

                return back()->with('success', 'Address saved successfully!');
            } else {
                return back()->with('error', 'Selected address not found.');
            }
        }

        $order->save();

        foreach ($cart->products as $product) {
            $productId = $product->id;

            // Obtener la cantidad desde la tabla pivote cartproduct
            $pivotData = $cart->products()->where('product_id', $productId)->first()->pivot;
            $amount = $pivotData->amount; // Asumiendo que la cantidad está almacenada en la columna 'amount' de la tabla pivote

            // Asociar el producto y la cantidad al pedido
            $order->products()->attach($productId, ['amount' => $amount]);
        }

        // Enviar correo electrónico (comentado mientras practicamos para no tener 21701293 correos)
        Mail::to($user->email)->send(new OrderConfirmation($order));

        // Puedes limpiar el carrito después de realizar el pedido si es necesario
        $cart->products()->detach();

        return redirect()->route('orders')->with('success', 'Payment successful!');
    }


    public function remove($productId)
    {
        $user = Auth::user(); //obtencion del usuario
        $cart = $user->cart; //

        if ($cart) {
            $cart->products()->detach($productId);
            return back()->with('success', 'Product removed.');
        }

        return back()->with('error', 'There is not any cart.');
    }

    public function increase(Product $product)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Verificar si el producto ya está en el carrito
        $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

        if ($pivotRecord) {
            // Aumentar la cantidad en 1
            $pivotRecord->pivot->update(['amount' => $pivotRecord->pivot->amount + 1]);
        }


        return redirect()->back()->with('mensaje', 'Product quantity increased.');
    }

    public function decrease(Product $product)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Verificar si el producto ya está en el carrito
        $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

        if ($pivotRecord) {
            // Disminuir la cantidad en 1, evitando que sea menor a 0
            $pivotRecord->pivot->update(['amount' => max($pivotRecord->pivot->amount - 1, 0)]);
        }


        return redirect()->back()->with('mensaje', 'Product quantity decreased.');
    }

    public function viewShipping()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('products.shipping', compact('addresses'));
    }

    public function createNewAddressShipping(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
        ]);

        // Comprobar si la dirección ya existe para el usuario actual
        $existingAddress = Address::where([
            'user_id' => auth()->user()->id,
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'zipCode' => $request->input('zipcode'),
        ])->first();

        if ($existingAddress) {
            // La dirección ya existe, puedes manejarlo de la forma que prefieras
            return redirect()->route('cart.viewShipping')->with('error', 'Address already exists.');
        }

        // Si no existe, crea la nueva dirección
        $newAddress = new Address;
        $newAddress->address = $request->input('address');
        $newAddress->country = $request->input('country');
        $newAddress->city = $request->input('city');
        $newAddress->zipCode = $request->input('zipcode');
        $newAddress->user_id = auth()->user()->id;

        $newAddress->save();

        // Redirigir a la página de envío en lugar de 'profile.address'
        return redirect()->route('cart.viewShipping')->with('mensaje', 'Address added successfully');
    }

}
