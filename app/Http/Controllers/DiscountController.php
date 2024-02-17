<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function store (Request $request) 
    {
        $discount = Discount::where("code", $request->discount_code)->first();
        dd($discount);
    }

    public function destroy (Request $request) 
    {
        return "deleting discount";
    }
}
