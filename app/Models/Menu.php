<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%");
    }

    public function scopeFilterByCategory($query, $category_id)
    {
        if ($category_id) {
            return $query->where('category_id', $category_id);
        }

        return $query;
    }

    public function scopeFilterByPrice($query, $min, $max)
    {
        if ($min || $max) {
            return $query->whereBetween('price', [$min ?? 0, $max ?? PHP_INT_MAX]);
        }

        return $query;
    }

    public function scopeFilterByAvailability($query, $isAvailable)
    {
        if ($isAvailable !== null) {
            $isAvailable = filter_var($isAvailable, FILTER_VALIDATE_BOOLEAN);
            return $query->where('is_available', $isAvailable);
        }

        return $query;
    }
}
