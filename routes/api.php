<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\File;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users',function(){
    return  User::all();
});

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