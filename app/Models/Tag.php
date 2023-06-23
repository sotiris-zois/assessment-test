<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasManyThrough(Product::class,'tags_products_pivot','id','id','product_id','tag_id');
    }
}
