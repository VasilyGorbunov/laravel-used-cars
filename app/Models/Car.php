<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class Car extends Model
{
    use HasFactory, Searchable;

    protected static $unguarded = true;

    protected static function booted()
    {
        static::deleted(function (Car $car) {
            foreach ($car->images as $image) {
                Storage::delete($image);
            }
        });

        static::updating(function (Car $car) {
            $imagesToDelete = array_diff($car->getOriginal('images'), $car->images);
            foreach ($imagesToDelete as $image) {
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

    public function searchableAs(): string
    {
        return 'cars_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
        ];
    }
}
