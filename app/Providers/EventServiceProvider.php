<?php

namespace App\Providers;

use App\Events\OrderSuccessEvent;
use App\Listeners\SendEmailToAdminWhenOrderSuccess;
use App\Listeners\SendEmailToCustomerWhenOrderSuccess;
use App\Listeners\SendSmsToCustomerWhenOrderSuccess;
use App\Listeners\UpdateStatusOrderWhenOrderSuccess;
use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderSuccessEvent::class => [
            SendEmailToCustomerWhenOrderSuccess::class,
            SendEmailToAdminWhenOrderSuccess::class,
            // SendSmsToCustomerWhenOrderSuccess::class,
            UpdateStatusOrderWhenOrderSuccess::class
        ],
    ];

    protected $observers = [
        Product::class => [ProductObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
