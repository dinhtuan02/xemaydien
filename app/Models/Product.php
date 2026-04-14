<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'quantity',
        'color',
        'max_speed',
        'range_per_charge',
        'battery_capacity',
        'charging_time',
        'thumbnail',
        'short_description',
        'description',
        'specifications',
        'sold_count',
        'is_featured',
        'is_new',
        'is_sale',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_sale' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['final_price', 'average_rating'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->sale_price && $this->sale_price > 0
            ? $this->sale_price
            : $this->price;
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('is_approved', true)->avg('rating') ?? 0, 1);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name . '-' . time());
            }
        });
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->thumbnail) {
            return asset('assets/images/no-image.png');
        }

        if (str_starts_with($this->thumbnail, 'assets/')) {
            return asset($this->thumbnail);
        }

        return asset('storage/' . $this->thumbnail);
    }
}
