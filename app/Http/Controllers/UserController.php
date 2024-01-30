<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $cartController;

 
    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }

  
    public function create(array $input)
    {
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->rol_id = 1;

        $user->save();

        $this->cartController->create($user->id);

        $this->cartController->create($user->id);
        return $user;
    }

    
    public function products()
    {
        $products = Product::all();
        return view('/logged')->with('products', $products);
    }
}
