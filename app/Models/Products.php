<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
   protected $guarded=[];
   public function images(): HasMany
   {
       return $this->hasMany(ProductImage::class, 'product_id');
   }
   public function tags()
   {
       return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();
   }
}
