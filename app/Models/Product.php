<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','desc','price','category_id','user_id'];
    protected $casts = ['category_id'=> 'integer','price'=>'integer'];

    public function image(){
     return $this->hasMany(Image::class);
    }

   public function category(){
    return $this->belongsTo(Category::class);
   }

   public function user(){
       return $this->belongsTo(User::class);
   }
}
