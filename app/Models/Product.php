<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'name', 'code', 'price', 'release_date', 'created_at', 'updated_at'
    ];

    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_products_pivot', 'product_id', 'tag_id');
    }

    public function scopeWithIndices($query, $indices)
    {
        $table = $this->getTable();
        $indices = implode(', ', $indices);

        return $query->from(DB::raw("{$table} USE INDEX ({$indices})"));
    }
}
