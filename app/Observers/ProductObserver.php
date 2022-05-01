<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductNotification;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        
        $notification = new ProductNotification();
        $notification->message = "you have successfully created a product";
        $notification->product_id = $product->id;
        $notification->save();


    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $notification = new ProductNotification();
        $notification->message = "you have successfully removed one  product";
        $notification->product_id = $product->id;
        $notification->save();
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}


// Solid Joystick Protect Cover Controller Shell & Buttons Kit Housing for Play Station 5 Controller Case

// Lenovo ThinkPad X131e
// HDD 320gb
// Ram 2gb
// 11.60 inch


// HP ProBook 640 G1 Intel Core i5 2.5GHz 4GB 500GB HDD

// Processor 2.5 ghz Core i5-4200m
// RAM 4GB ddr3 sdram
// Hard Drive 320GB
// Screen size 14 inches


// White Fine Twill Slim Fit Shirt
// Egyptian Cotton by Albini, Italy
// $119

// Tailored to a slim fit with a curved cutaway collar, this crisp white button-up is cut from pure, soft Egyptian cotton twill by Italy's Albini mill.



// Mid Blue Havana Suit
// Wool Silk by Colombo, Italy
// $999

// An elevated take on a classic, this stunning mid blue Havana is tailored slim with a full canvas interior. Cut from a wool-silk blend by the Colombo mill, it features patch pockets and a natural shoulde
