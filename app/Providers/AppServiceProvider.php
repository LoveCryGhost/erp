<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Member::observe(\App\Observers\MemberObserver::class);

        \App\Models\Type::observe(\App\Observers\TypeObserver::class);
        \App\Models\Attribute::observe(\App\Observers\AttributeObserver::class);
        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\SKU::observe(\App\Observers\SKUObserver::class);
        \App\Models\Supplier::observe(\App\Observers\SupplierObserver::class);
        \App\Models\SupplierGroup::observe(\App\Observers\SupplierGroupObserver::class);
        \App\Models\SupplierContact::observe(\App\Observers\SupplierContactObserver::class);

        \App\Models\CrawlerTask::observe(\App\Observers\CrawlerTaskObserver::class);
        \App\Models\Staff::observe(\App\Observers\StaffObserver::class);

        \App\Models\StaffExcelLike::observe(\App\Observers\StaffExcelLikeObserver::class);
    }
}
