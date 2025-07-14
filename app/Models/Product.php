<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category_id', 'image', 'is_active', 'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Check if the image is a full URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            
            // Check if the image exists in storage
            if (Storage::disk('public')->exists($this->image)) {
                return Storage::url($this->image);
            }

            // Check if image exists in public folder
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
        }
        
        // Return a placeholder image if no image is set or not found
        return asset('images/placeholder.jpg');
    }

    // Definisikan relasi Many-to-One (Banyak Produk milik satu Kategori)
    public function category()
    {
        // Mendefinisikan relasi belongsTo ke model Category
        // Menyatakan setiap produk hanya punya satu kategori (foreign key: category_id)
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
