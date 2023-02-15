<?php

namespace App\Providers;

use App\Mail\UserChanged;
use App\Mail\UserCreated;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user) {
            retry(5, function() use ($user) { 
                Mail::to($user)->send(new UserCreated($user));
            }, 1000);
        });

        User::updated(function($user) {
            if($user->isDirty('email')) {
                retry(5, function() use ($user) { 
                    Mail::to($user)->send(new UserChanged($user));
                }, 1000);
            }
        });

        Product::updated(function($product) {
            if($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });
    }
}
