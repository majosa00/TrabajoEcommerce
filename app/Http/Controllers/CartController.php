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
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
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
        DB::commit();
        return redirect()->route('cart.view')->with('success', 'Product added to the cart.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Failed to add product to the cart.');
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

        // if ($request->filled('address')) {
        //     $selectedAddressId = $request->input('address');
        //     $selectedAddress = Address::find($selectedAddressId);

        //     if ($selectedAddress) {
        //         // Crear un array con los detalles de la dirección seleccionada
        //         $addressDetails = [
        //             'address' => $selectedAddress->address,
        //             'city' => $selectedAddress->city,
        //             'country' => $selectedAddress->country,
        //             'zipcode' => $selectedAddress->zipCode,
        //         ];

        //         // Convertir los detalles de la dirección en una cadena
        //         $formattedAddress = implode(', ', $addressDetails);
        //         // Guardar la dirección en la base de datos o realizar acciones adicionales según tus necesidades
        //         $order->address = $formattedAddress;

        //         return back()->with('success', 'Address saved successfully!');
        //     } else {
        //         return back()->with('error', 'Selected address not found.');
        //     }
        // }

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
        // Mail::to($user->email)->send(new OrderConfirmation($order));
        // Mail::to($user->email)->send(new TicketEmail($order));
        // $pdf = PDF::loadView('emails.ticket', compact('order'));
        // $pdf->save(storage_path('app/public/tickets/ticket_' . $order->id . '.pdf'));

        // Puedes limpiar el carrito después de realizar el pedido si es necesario
        $cart->products()->detach();

        return redirect()->route('orders')->with('success', 'Payment successful!');
    }

    public function remove($productId)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user(); // Obtención del usuario
            $cart = $user->cart; // Obtención del carrito del usuario
    
            if (!$cart) {
                DB::rollBack(); // Se hace rollback porque no hay carrito, aunque aquí podría ser opcional dado que no hay cambios aún
                return back()->with('error', 'There is not any cart.');
            }
    
            $cart->products()->detach($productId);
            DB::commit(); // Confirmamos los cambios en la base de datos
            return back()->with('success', 'Product removed.');
        } catch (\Exception $e) {
            DB::rollBack(); // Revertimos cambios en caso de error
            return back()->with('error', 'Failed to remove the product.');
        }
    }
    
    public function increase(Product $product)
{
    DB::beginTransaction();
    try {
        $user = Auth::user(); // Obtención del usuario
        $cart = $user->cart; // Obtención del carrito del usuario

        // Verificar si el producto ya está en el carrito
        $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

        if ($pivotRecord) {
            // Aumentar la cantidad en 1
            $pivotRecord->pivot->update(['amount' => $pivotRecord->pivot->amount + 1]);
            DB::commit(); // Confirmamos los cambios en la base de datos
            return redirect()->back()->with('mensaje', 'Product quantity increased.');
        } else {
            DB::rollBack(); // Revertimos cambios ya que no se encontró el producto en el carrito
            return back()->with('error', 'Product not found in the cart.');
        }
    } catch (\Exception $e) {
        DB::rollBack(); // Revertimos cambios en caso de error
        return back()->with('error', 'Failed to increase the product quantity.');
    }
}


public function decrease(Product $product)
{
    DB::beginTransaction();
    try {
        $user = Auth::user();
        $cart = $user->cart;

        // Verificar si el producto ya está en el carrito
        $pivotRecord = $cart->products()->where('product_id', $product->id)->first();

        if ($pivotRecord) {
            // Disminuir la cantidad en 1, evitando que sea menor a 0
            $pivotRecord->pivot->update(['amount' => max($pivotRecord->pivot->amount - 1, 1)]);
            DB::commit();
            return redirect()->back()->with('mensaje', 'Product quantity decreased.');
        } else {
            DB::rollBack();
            return back()->with('error', 'Product not found in the cart.');
        }
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Failed to decrease product quantity.');
    }
}


    public function viewShipping()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('products.shipping', compact('addresses'));
    }

   public function updatedatas(Request $request)
{
    DB::beginTransaction();
    try {
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

        DB::commit(); // Confirmar los cambios en la base de datos
        return redirect()->route('cart.viewShipping')->with('success', 'Shipping information saved successfully!');
    } catch (\Exception $e) {
        DB::rollBack(); // Revertir todos los cambios si ocurre un error
        return back()->with('error', 'Failed to save shipping information.');
    }
}

public function createNewAddressShipping(Request $request)
{
    DB::beginTransaction();
    try {
        // Validar los datos del formulario...
        $existingAddress = Address::where([
            // Condiciones para buscar la dirección existente...
        ])->first();

        if ($existingAddress) {
            DB::rollBack();
            return redirect()->route('cart.viewShipping')->with('error', 'Address already exists.');
        }

        $newAddress = new Address([
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'zipCode' => $request->input('zipcode'),
            'user_id' => auth()->user()->id,
        ]);
        $newAddress->save();

        DB::commit();
        return redirect()->route('cart.viewShipping')->with('success', 'Address added successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Failed to add the address.');
    }
}

    public function processpayment(Request $request)
    {
        $request->validate([
            'cc-name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'cc-number' => 'required|numeric',
            'cc-expiration' => 'required|date_format:m/y',
            'cc-cvv' => 'required|numeric',
        ]);

        return redirect()->route('cart.viewShipping')->with('mensaje', 'Address added successfully');
    }

}
