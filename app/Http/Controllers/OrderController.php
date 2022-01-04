<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function index(){
        $user = auth()->user();
      $orders =  OrderResource::collection(Order::where('user_id',$user->id)->latest()->get());
    return $orders;

    }

    public function create_order(Request $request){
   
     $order = new Order();
     $user = auth()->user();
     $info = $request->all();
     $info['user_id'] = $user->id;
     return $order->create($info);

    }

    public function add_order_item(Request $request){

        foreach ($request->order_items as $item) {
            $order_item = new OrderItem();
            $order_item->order_id = $request->order_id;
            
            $order_item->price = $item['price'];
            $order_item->name = $item['name'];
            $order_item->amount = $item['total_amount'];
            $order_item->image = $item['image'];
            $order_item->quantity = $item['quantity'];
            $order_item->save();     
        }

        $all_orders = OrderResource::collection(Order::latest()->get());

        return response()->json(['message'=>'item saved successfully','orders'=>$all_orders],201);
    }
}


// A9C145F4-0552-4281-B4B7-5D6A0D42FCF0