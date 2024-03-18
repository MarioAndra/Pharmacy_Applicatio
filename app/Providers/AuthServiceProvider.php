<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Support\Facades\Gate;
use App\Policies\product_policy;
use App\Policies\user_policy;
use App\Policies\category_policy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class=>product_policy::class,
        User::class=>user_policy::class,
        Category::class=>category_policy::class,
    ];

 
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
