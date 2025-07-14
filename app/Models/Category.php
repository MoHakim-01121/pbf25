<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    
    // Mendefinisikan relasi hasMany ke model Product
    // Menyatakan satu kategori dapat memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
