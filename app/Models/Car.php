<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    protected static function booted()
    {
        static::deleting(function (Car $car) {
            foreach ($car->images as $image) {
                Storage::delete($image);
            }
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Number::currency($attributes['price'])
        );
    }

    protected $casts = [
        'images' => 'json'
    ];
}
