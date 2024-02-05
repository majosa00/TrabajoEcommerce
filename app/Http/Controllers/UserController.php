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

    public function changePassword()
    {

    }

    public function changeAddress()
    {

    }

    public function updateAddress(Request $request, $id)
    {
        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);
        $address->update($request->except('_token', '_method'));

        return redirect()->route('dashboard')->with('address_updated', true);
    }

    public function saveAddress(Request $request)
    {
        $user = Auth::user();
        $user->addresses()->create($request->except('_token'));

        return redirect()->route('dashboard')->with('address_added', true);
    }

    public function deleteAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);
        $address->delete();

        return redirect()->route('dashboard')->with('address_deleted', true);
    }

}