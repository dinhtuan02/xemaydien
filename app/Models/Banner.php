<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('assets/images/no-image.png');
        }

        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }
}
