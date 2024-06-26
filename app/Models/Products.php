<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class Products extends Model
{
    use SoftDeletes;
   protected $guarded=[];
   public function images(): HasMany
   {
       return $this->hasMany(ProductImage::class, 'product_id');
   }
   public function tags()
   {
       return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();//tránh null liên quan đến time 
   }
   public function category()
   {
       return $this->belongsTo(Category::class,'category_id');//tránh null liên quan đến time 
   }
   public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id');
   }
}
