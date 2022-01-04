<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
             
             'total_amount'=> $this->total_amount,
             'user_id'=>$this->user_id,
             'id'=>$this->id,
             'items_count'=>$this->items_count,
             'date_placed'=>$this->created_at->toDateString(),
             'order_items'=>$this->orderItem       

        ];
    }
}
