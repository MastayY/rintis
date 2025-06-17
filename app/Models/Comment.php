<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'parent_id',
        'content',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function replies(): HasMany {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies', 'user');
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
