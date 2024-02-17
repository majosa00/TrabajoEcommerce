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
use App\Mail\OrderConfirmation;
use App\Mail\TicketEmail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        DB::beginTransaction();

        try {
            // Obtener el usuario autenticado actualmente
            $user = Auth::user();
            // Buscar en la base de datos el ID del producto
            $product = Product::find($productId);

            if (!$product) {
                // Si no lo encuentra, vuelve a la página anterior con un mensaje de error
                DB::rollBack();
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

            // Confirmar la transacción
            DB::commit();

            // Si funciona, redirige a la página anterior con un mensaje de éxito indicando que el producto fue añadido al carrito
            return redirect()->route('cart.view')->with('success', 'Product added to the cart.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            // Opcional: manejar el error, logearlo, o mostrar un mensaje de error específico.
            return back()->with('error', 'An error occurred while adding the product to the cart.');
        }
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
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cart = $user->cart;

            // Verificar si el usuario ha proporcionado los datos necesarios
            if (!$user->name || !$user->secondname || !$user->email || !$user->phone) {
                return back()->with('mensaje', 'Please complete your user profile before placing an order.');
            }

            $order = new Order();
            $order->user_id = $user->id;
            $order->state = 'Pending';
            $order->orderDate = now();

            $totalPrice = $cart->products->sum(function ($product) {
                return $product->price * $product->pivot->amount;
            });
            $order->totalPrice = $totalPrice;
            $order->user = "{$user->name} {$user->secondname}, {$user->email}, {$user->phone}";

            // Obtén el ID de la dirección seleccionada desde el formulario
            $selectedAddressId = $request->input('selected_address');
            // Obtén los detalles de la dirección seleccionada
            if ($selectedAddressId) {
                $selectedAddress = Address::find($selectedAddressId);
                $order->address = "{$selectedAddress->address}, {$selectedAddress->country}, {$selectedAddress->city}, {$selectedAddress->zipCode}";
            } else {
                return back()->with('mensaje', 'Please select an address before placing an order.');
            }

            $order->save();

            foreach ($cart->products as $product) {
                $order->products()->attach($product->id, ['amount' => $product->pivot->amount]);
            }

            // Enviar correo electrónico (comentado mientras practicamos para no tener 21701293 correos)
            // Mail::to($user->email)->send(new OrderConfirmation($order));
            // Mail::to($user->email)->send(new TicketEmail($order));
            // $pdf = PDF::loadView('emails.ticket', compact('order'));
            // $pdf->save(storage_path('app/public/tickets/ticket_' . $order->id . '.pdf'));

            // Puedes limpiar el carrito después de realizar el pedido si es necesario
            $cart->products()->detach(); // Limpiar el carrito

            DB::commit();
            return redirect()->route('orders')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error or handle it as necessary
            return back()->with('error', 'An error occurred during the payment process.');
        }
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
        try {
            // Iniciar la transacción
            DB::beginTransaction();

            $user = Auth::user();
            $cart = $user->cart;

            // Verificar si el producto ya está en el carrito
            $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

            if ($pivotRecord) {
                // Aumentar la cantidad en 1
                $pivotRecord->pivot->update(['amount' => $pivotRecord->pivot->amount + 1]);
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->back()->with('mensaje', 'Product quantity increased.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Opcional: manejar el error, logearlo, o mostrar un mensaje de error específico.
            return redirect()->back()->with('error', 'Error increasing product quantity.');
        }
    }


    public function decrease(Product $product)
    {
        try {
            // Iniciar la transacción
            DB::beginTransaction();

            $user = Auth::user();
            $cart = $user->cart;

            // Verificar si el producto ya está en el carrito
            $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

            if ($pivotRecord) {
                // Disminuir la cantidad en 1, evitando que sea menor a 0
                $pivotRecord->pivot->update(['amount' => max($pivotRecord->pivot->amount - 1, 1)]);
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->back()->with('mensaje', 'Product quantity decreased.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Opcional: manejar el error, logearlo, o mostrar un mensaje de error específico.
            return redirect()->back()->with('error', 'Error decreasing product quantity.');
        }
    }

    public function viewShipping()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('products.shipping', compact('user', 'addresses'));
    }

    public function updatedatas(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Actualizar los datos del usuario con la información del formulario
        $user = Auth::user();
        $user->name = $validatedData['name'];
        $user->secondname = $validatedData['secondname'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->save();

        // Redirigir a la vista de envío con un mensaje de éxito
        return redirect()->route('cart.viewShipping')->with('success', 'Shipping information saved successfully!');
    } // Este es el cierre de llave que falta

    public function createNewAddressShipping(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
        ]);

        // Obtener el usuario actual
        $user = Auth::user();

        // Comprobar si el usuario ya tiene el máximo permitido de direcciones
        $maxAddresses = 4;
        if ($user->addresses()->count() >= $maxAddresses) {
            return redirect()->route('cart.viewShipping')->with('mensaje', 'Maximum addresses limit reached.');
        }

        // Comprobar si la dirección ya existe para el usuario actual
        $existingAddress = Address::where([
            'user_id' => $user->id,
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'zipCode' => $request->input('zipcode'),
        ])->first();

        if ($existingAddress) {
            return redirect()->route('cart.viewShipping')->with('error', 'Address already exists.');
        }

        // Si no existe y el límite no se ha alcanzado, crea la nueva dirección
        $newAddress = new Address;
        $newAddress->address = $request->input('address');
        $newAddress->country = $request->input('country');
        $newAddress->city = $request->input('city');
        $newAddress->zipCode = $request->input('zipcode');
        $newAddress->user_id = $user->id;

        $newAddress->save();

        return redirect()->route('cart.viewShipping')->with('mensaje', 'Address added successfully');
    }

    public function getCartItemCount()
    {
        $user = Auth::user();
        if ($user && $user->cart) {
            $count = $user->cart->products->sum('pivot.amount');
            \Log::info("Cart item count: " . $count);
            return $count;
        }
        return 0;
    }

}
