<?php

namespace App\Listeners;

use App\Events\SendInvoicePDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvoiceListener
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
     * @param  SendInvoicePDF  $event
     * @return void
     */
    public function handle(SendInvoicePDF $event)
    {
        return view('index')->with('success', 'commande bien validée');
    }
}
