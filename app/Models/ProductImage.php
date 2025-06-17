<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Product;

class ProductImage extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'product_id', 'image_url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
