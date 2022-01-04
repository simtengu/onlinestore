<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\File;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Resources\OrderResource;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

    // Route::get('/users',function(){
    //     return  User::all();
    // });

Route::post('/signin',[AuthController::class,'login'])->name('signin');
Route::get('/login',function(){
  return "login now";
})->name('login');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/signin',[AuthController::class,'login'])->name('sign_in');


Route::apiResource('/products',ProductController::class);
Route::get('/user',function(){
    $user = User::findOrFail(1);
  return new UserResource($user);
});

Route::get('/product',function(){
  $product = Product::all();
  return  ProductResource::collection($product);
});

Route::get('/categories',function(){
   $categories = Category::all();
  return CategoryResource::collection($categories);
});
Route::post('/upload/product_image',function(Request $data){
 
        if ($file = $data->file('image')) {

                $pic_name = time().$file->getClientOriginalName();
                 $file->move('images',$pic_name);
                $photo = new Image();
                $photo->name = $pic_name;
                $photo->product_id = $data->formId;
                $photo->save();
                return response()->json(['image'=>$photo]);
           
        }
        return "nothing";

});

Route::delete('/product_image/delete/{id}',function($id){
 $img = Image::findOrFail($id);
                 $pic_name = $img->name;
                 if (File::exists(public_path('/images').'/'.$pic_name)) {
                   File::delete(public_path('/images').'/'.$pic_name);
                 }
 return $img->delete();

});
Route::get('/user/products',[ProductController::class,'get_user_products']);
Route::get('/orders',[OrderController::class,'index'])->name('order.index');
Route::post('/order',[OrderController::class,'create_order'])->name('order.create');
Route::post('/order/add_order_item',[OrderController::class,'add_order_item'])->name('order.item.create');
Route::get('/testing',function(){
     return  OrderResource::collection(Order::all());
});


Route::get('/search_product/{key}',function($key){
    $products = Product::where('name','LIKE','%'.$key.'%')->get();
    return ProductResource::collection($products);

});

Route::get('/weeklyOffer',function(){
 $product = Product::whereHas('category',function($query){
    $query->where('name','computer');
 })->latest()->first();
 if ($product) {
   return new ProductResource($product);
 }
 return response()->json(['message'=>'no product'],200);
 
});

Route::get('/get_user',function(){
  return auth()->user();
})->middleware('auth:sanctum');

Route::get('/logout',function(){
    $user = auth()->user();
    $user->tokens()->delete();
    return response()->json(['status'=>'success'],200);
})->name('logout')->middleware('auth:sanctum');