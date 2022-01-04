<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
             return [
             'id'=>$this->id,
             'user_id'=>$this->user_id,
             'total_amount'=> $this->total_amount,
             'items_count'=>$this->items_count,
             'date_placed'=>$this->created_at->toDateString(),
             'order_items'=>$this->orderItem       

        ];
    }
}
