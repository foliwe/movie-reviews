<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;


    protected $fillable =['comment','rating'];

    public function movie(): BelongsTo
        {
            return $this->belongsTo(Movie::class);
        }

    protected static function booted()
    {

        static::updated(fn(Review $review) => cache()->forget('movie:' . $review->movie_id));
        static::deleted(fn(Review $review) => cache()->forget('movie:' . $review->movie_id));
    }
}