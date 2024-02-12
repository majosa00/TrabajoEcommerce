<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; 

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $itemCount = 0;
                if ($user->cart) {
                    $itemCount = $user->cart->products->sum('pivot.amount');
                }
                $view->with('itemCount', $itemCount);
            } else {
                $view->with('itemCount', 0);
            }
        });
    }
}
