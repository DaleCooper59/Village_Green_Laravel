<?php

namespace App\Listeners;

use App\Events\StockLowEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StockLowListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StockLowEvent  $event
     * @return void
     */
    public function handle(StockLowEvent $event)
    {
        //
    }
}
