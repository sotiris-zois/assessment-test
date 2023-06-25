<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Observers\ProductObserver;

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

    protected static function boot()
    {
        parent::boot();

        // Attach the observer to the model
        self::observe(ProductObserver::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_products_pivot', 'tag_id', 'product_id');
    }

    public function scopeWithIndices($query, $indices)
    {
        $table = $this->getTable();
        $indices = implode(', ', $indices);

        return $query->from(DB::raw("{$table} USE INDEX ({$indices})"));
    }
}
