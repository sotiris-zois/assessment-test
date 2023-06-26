<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class,'tags_products_pivot','id','id','product_id','tag_id');
    }
}
