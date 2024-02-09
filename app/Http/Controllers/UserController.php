<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(array $input)
    {
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->rol_id = 1;
        $user->save();

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        return $user;
    }

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
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Actualizar el nombre y correo electrónico del usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile')->with('mensaje', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        // Comprobar que la contraseña actual coincide
        if (Hash::check($request->input('password'), $user->password)) {

            // Comprobar que la nueva contraseña y la confirmación coinciden
            if ($request->input('new_password') === $request->input('new_password_confirmation')) {

                // Cambiar la contraseña
                $user->password = Hash::make($request->input('new_password'));
                $user->save();

                return redirect()->route('profile')->with('mensaje', 'Password changed successfully!');
            } else {
                return redirect()->route('profile')->withErrors(['new_password_confirmation' => 'New password and confirmation do not match.']);
            }
        } else {
            return redirect()->route('profile')->withErrors(['password' => 'Current password is incorrect.']);
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
            'address' => 'required|unique:addresses,address|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'zipcode' => 'required|max:10',
        ]);

        $newAddress = new Address;
        $newAddress->address = $request->input('address');
        $newAddress->country = $request->input('country');
        $newAddress->city = $request->input('city');
        $newAddress->zipCode = $request->input('zipcode');
        $newAddress->user_id = auth()->user()->id;

        $newAddress->save();

        return redirect()->route('profile')->with('mensaje', 'Address added successfully');
    }

    public function deleteAddress($id)
    {

    }

    public function editAddress()
    {

    }

    public function updateAddress(Request $request, $id)
    {

    }

}
