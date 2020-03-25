<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //監聽EmailVerified事件
        \Illuminate\Auth\Events\Verified::class => [
            \App\Listeners\EmailVerified::class,
        ],

        //監聽重置密碼
        PasswordReset::class => [
            \App\Listeners\ResetPassword::class,
        ],

        //User登入監聽
        'App\Events\UserLoginSuccessfulEvent' => [
            'App\Listeners\UserLoginSuccessfulListener',
        ],
        //Member登入監聽
        'App\Events\MemberLoginSuccessfulEvent' => [
            'App\Listeners\MemberLoginSuccessfulListener',
        ],

        //Staff登入監聽
        'App\Events\StaffLoginSuccessfulEvent' => [
            'App\Listeners\StaffLoginSuccessfulListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
