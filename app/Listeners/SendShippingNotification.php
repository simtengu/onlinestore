<?php

namespace App\Listeners;

use App\Models\OrderNotification;
use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShippingNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
         $notification = new OrderNotification();
         $order_owner = $event->order->user->name;
         $notification->customer = $order_owner;
         $notification->message = "Dear ".$order_owner." your order has  been placed";
         $notification->save();
    }
}
