<?php

namespace App\Models;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'price',
        'stock',
        'status',
        'description',
        'thumbnail',
        'variant',
    ];

    protected $cast = [
        'variant' => 'array',
        'status' => 'boolean',
    ];


    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
