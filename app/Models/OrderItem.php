<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['name','id','price','amount','image','quantity','order_id'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
