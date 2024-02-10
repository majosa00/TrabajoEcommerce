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
            'secondname' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|integer',
        ]);

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
            'address' => 'required|string|max:255|unique:addresses,address,NULL,id,user_id,' . auth()->user()->id,
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|integer',
        ]);

        $newAddress = new Address;
        $newAddress->address = $request->input('address');
        $newAddress->country = $request->input('country');
        $newAddress->city = $request->input('city');
        $newAddress->zipCode = $request->input('zipcode');
        $newAddress->user_id = auth()->user()->id;
        $newAddress->save();

        return redirect()->route('profile.address')->with('mensaje', 'Address added successfully');

    }

    public function deleteAddress($id)
    {
        $addressDelete = Address::findOrFail($id);
        $addressDelete->delete();
        return back()->with('mensaje', 'Product removed');
    }

    public function updateAddress(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'address' => 'required|string|max:255|unique:addresses,address,' . $id . ',id,user_id,' . auth()->user()->id,
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|integer',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        $addressUpdate = Address::findOrFail($id);
        $addressUpdate->address = $request->address;
        $addressUpdate->country = $request->country;
        $addressUpdate->city = $request->city;
        $addressUpdate->zipCode = $request->zipcode;
        $addressUpdate->user_id = auth()->user()->id;
        $addressUpdate->save();

        return back()->with('mensaje', 'Address updated');
    }

}
