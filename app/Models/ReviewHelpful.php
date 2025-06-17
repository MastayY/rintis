<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Review;

class ReviewHelpful extends Model
{
    //
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'user_id',
        'review_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function review() {
        return $this->belongsTo(Review::class);
    }

}
