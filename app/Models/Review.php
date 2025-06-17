<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Product;
use App\Models\ReviewHelpful;

class Review extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'rating',
        'body',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function helpfuls() {
        return $this->hasMany(ReviewHelpful::class);
    }

    public function helpfulCount() {
        return $this->helpfuls()->count();
    }

}
