<?php

namespace App\Providers;

use App\Events\SendInvoicePDF;
use App\Events\StockLowEvent;
use App\Listeners\SendInvoiceListener;
use App\Listeners\StockLowListener;
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
        StockLowEvent::class => [
            StockLowListener::class,
        ],
        SendInvoicePDF::class => [
            SendInvoiceListener::class,
        ],
       
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
