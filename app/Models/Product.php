<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['name', 'color', 'description','price','category_id','brand_id', 'thumbnail'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
        // return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
} 
