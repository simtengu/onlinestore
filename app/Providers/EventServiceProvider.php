<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Observers\ProductObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use App\Listeners\SendWelcomeNotification;
use App\Listeners\SendShippingNotification;
use App\Events\OrderPlaced;
use App\Events\NewUserRegistered;
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
    NewUserRegistered::class => [
        SendWelcomeNotification::class,
    ],
    OrderPlaced::class=>[
        SendShippingNotification::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        User::observe(UserObserver::class);
    }
}
