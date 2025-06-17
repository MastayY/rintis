<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Comment;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'tagline',
        'slug',
        'description',
        'website_url',
        'image_url',
    ];

    protected static function booted() : void
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->title);
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
