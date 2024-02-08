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

        // $this->cartController->create($user->id); 

        $cart = new Cart(); //
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

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword()
    {

    }

    public function changeAddress()
    {

    }

    public function updateAddress(Request $request, $id)
    {

    }

    public function saveAddress(Request $request)
    {

    }

    public function deleteAddress($id)
    {

    }

}