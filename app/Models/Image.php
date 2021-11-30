<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['name','product_id','id'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    // public function getNameAttribute($value){
    //     return "http://localhost/onlineStore/public/images/".$value;
    // }
}
