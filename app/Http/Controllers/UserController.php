<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // public function create(array $input)
    // {
    //     // Inicia una transacción de base de datos
    //     DB::beginTransaction();
    
    //     try {
    //         $user = new User();
    //         $user->name = $input['name'];
    //         $user->email = $input['email'];
    //         $user->password = Hash::make($input['password']);
    //         $user->rol_id = 1;
    //         $user->save(); // Guarda el usuario en la base de datos
    
    //         $cart = new Cart();
    //         $cart->user_id = $user->id; // Asigna el ID del usuario recién creado
    //         $cart->save(); // Guarda el carro en la base de datos
    
    //         DB::commit(); // Confirma la transacción
    //         return $user;
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Si algo sale mal, revierte todas las operaciones
    //         throw $e; // Lanza la excepción para manejarla más arriba o mostrar el error
    //     }
    // }
    
    public function products()
    {
        $products = Product::all();
        return view('/logged')->with('products', $products);
    }

    public function brands()
    {
        $brands = Brand::all();
        return view('productsbrands')->with('brands', $brands);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|regex:/^[A-Za-z]+$/',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'secondname' => 'nullable|string|max:255|regex:/^[^\d]+$/',
        'birthday' => 'nullable|date',
        'phone' => 'nullable|integer',
    ]);

    DB::beginTransaction();

    try {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Actualizar solo los campos que se han proporcionado en la solicitud
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('secondname')) {
            $user->secondname = $request->input('secondname');
        }

        if ($request->filled('birthday')) {
            $user->birthday = $request->input('birthday');
        }

        if ($request->filled('phone')) {
            $user->phone = $request->input('phone');
        }

        $user->save();

        DB::commit(); // Confirma los cambios si todo ha ido bien

        return redirect()->route('profile')->with('mensaje', 'Profile updated successfully!');
    } catch (\Exception $e) {
        DB::rollBack(); // Revierte los cambios en caso de error

        // Aquí deberías redirigir al usuario a una página de error o devolver una respuesta indicando el fallo
        return redirect()->back()->withErrors(['error' => 'There was a problem updating the profile.']);
    }
}


public function changePassword(Request $request)
{
    DB::beginTransaction();

    try {
        $user = Auth::user();

        // Comprobar que la contraseña actual coincide
        if (Hash::check($request->input('password'), $user->password)) {

            // Comprobar que la nueva contraseña y la confirmación coinciden
            if ($request->input('new_password') === $request->input('new_password_confirmation')) {

                // Cambiar la contraseña
                $user->password = Hash::make($request->input('new_password'));
                $user->save();

                DB::commit(); // Confirma los cambios

                return redirect()->route('profile')->with('mensaje', 'Password changed successfully!');
            } else {
                DB::rollBack(); // Opcional, ya que no hay múltiples operaciones
                return redirect()->route('profile')->withErrors(['new_password_confirmation' => 'New password and confirmation do not match.']);
            }
        } else {
            DB::rollBack(); // Opcional, ya que no hay múltiples operaciones
            return redirect()->route('profile')->withErrors(['password' => 'Current password is incorrect.']);
        }
    } catch (\Exception $e) {
        DB::rollBack(); // Revierte los cambios en caso de error
        // Manejo del error
        return redirect()->route('profile')->withErrors(['error' => 'There was an unexpected error.']);
    }
}
    public function address()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('profile.profile', compact('addresses'));
    }


    public function createNewAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255|unique:addresses,address,NULL,id,user_id,' . auth()->user()->id,
            'country' => 'required|string|max:255|regex:/^[^\d]+$/',
            'city' => 'required|string|max:255|regex:/^[^\d]+$/',
            'zipcode' => 'required|numeric',
        ]);
    
        DB::beginTransaction();
    
        try {
            $newAddress = new Address;
            $newAddress->address = $request->input('address');
            $newAddress->country = $request->input('country');
            $newAddress->city = $request->input('city');
            $newAddress->zipCode = $request->input('zipcode');
            $newAddress->user_id = auth()->user()->id;
            
            $newAddress->save();
    
            DB::commit(); // Confirma los cambios si todo ha ido bien
    
            return redirect()->route('profile.address')->with('mensaje', 'Address added successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte los cambios en caso de error
    
            // Aquí deberías redirigir al usuario a una página de error o devolver una respuesta indicando el fallo
            return redirect()->route('profile.address')->withErrors(['error' => 'There was a problem adding the address.']);
        }
    }
    public function deleteAddress($id)
    {
        DB::beginTransaction();
    
        try {
            $addressDelete = Address::findOrFail($id);
            $addressDelete->delete();
    
            DB::commit(); // Confirma los cambios si la eliminación fue exitosa
    
            return back()->with('mensaje', 'Address removed successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte los cambios en caso de error
    
            // Maneja el error, por ejemplo, redirigiendo al usuario con un mensaje de error
            return back()->withErrors(['error' => 'There was a problem removing the address.']);
        }
    }

    public function updateAddress(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'address' => 'required|string|max:255|unique:addresses,address,' . $id . ',id,user_id,' . auth()->user()->id,
            'country' => 'required|string|max:255|regex:/^[^\d]+$/',
            'city' => 'required|string|max:255|regex:/^[^\d]+$/',
            'zipCode' => 'required|numeric',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            $addressUpdate = Address::findOrFail($id);
            $addressUpdate->address = $request->input('address');
            $addressUpdate->country = $request->input('country');
            $addressUpdate->city = $request->input('city');
            $addressUpdate->zipCode = $request->input('zipCode');
            $addressUpdate->user_id = $user->id;
            $addressUpdate->save();
    
            DB::commit(); // Confirma los cambios si todo ha ido bien
    
            return back()->with('mensaje', 'Address updated successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte los cambios en caso de error
    
            // Redirige al usuario con un mensaje de error
            return back()->withErrors(['error' => 'There was a problem updating the address.']);
        }
    }
}
