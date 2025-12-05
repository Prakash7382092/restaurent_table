<?php

namespace App\Providers;

use App\Models\Address;
use App\Policies\AddressPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register model policies here
        Gate::policy(Address::class, AddressPolicy::class);
    }
}
