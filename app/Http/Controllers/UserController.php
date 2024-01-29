<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //Crear usuario con el rol_id predeterminado
    public function create (array $input) {
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->rol_id=1;

        $user->save();

        return $user;
    }

    //Mostrar los productos
    public function products()
    {
        $products = Product::all();
        return view('/logged')->with('products', $products);
    }
}
