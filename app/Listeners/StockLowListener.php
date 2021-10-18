<?php

namespace App\Listeners;

use App\Events\StockLowEvent;
use App\Models\Todo;
use App\Models\User;
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
        $detail = "L'article ". $event->product->label . " est (presque) victime de son succès, pensez à renouveler le stock";
        $todo = Todo::create([
            'title' => 'stock',
            'detail' => $detail,
        ]);

        $supplyUser = User::role('supply')->get();
        $ids = $supplyUser->pluck('id');
      
        $todo->employees()->attach($ids);
        
        
    }
}
