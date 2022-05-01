<?php

namespace App\Http\Controllers;
use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Notifications\OrderPlaced as PlacedOrder;

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
     $aos = $order->create($info);
      
      OrderPlaced::dispatch($aos);
      $user->notify(new PlacedOrder($user->email));
      return $aos;


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


// 26|aPOUv2ZX0M6BxbJDxEsXB8HjyaBSb0fNuPSF335y