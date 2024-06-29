<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Movie extends Model
{
    use HasFactory;


    public function reviews(): HasMany
        {
            return $this->hasMany(Review::class);
        }



        public function scopeTitle(Builder $query, string $title): Builder
            {
            return $query->where('title', 'LIKE', '%'. $title . '%');
            }


        public function scopeWithReviewCount(Builder $query, $from = null, $to = null): Builder
        {
            return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ]);
        }


        public function scopeWithAverageRating(Builder $query, $from = null, $to = null): Builder
        {
            return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ], 'rating');
        }


        public function scopePopular(Builder $query, $from = null, $to = null): Builder
        {
            return $query->WithReviewCount()
            ->orderBy('reviews_count', 'desc');
        }


        public function scopeMinReviews(Builder $query, int $minReviews): Builder
        {
        return $query->having('reviews_count' ,'>=', $minReviews);
        }




        public function scopeMostRated(Builder $query, $from = null, $to = null): Builder
            {
            return $query->WithAverageRating()
            ->orderBy('reviews_avg_rating','desc');
        }


        private function dateRangeFilter(Builder $query, $from = null, $to = null)
        {
            if ($from && !$to) {
            $query->where('created_at', '>=', $from);
            } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to); } elseif ($from && $to) { $query->whereBetween('created_at', [$from, $to]);
                }
        }


        public function scopePopularLastMonth(Builder $query): Builder
        {
        return $query->Popular(now()->subMonth(), now())
        ->MostRated(now()->subMonth(), now())
        ->MinReviews(2);
        }


    public function scopePopularLastSixMonth(Builder $query): Builder
        {
        return $query->Popular(now()->subMonths(6), now())
        ->MostRated(now()->subMonths(6), now())
        ->MinReviews(3);
        }

    public function scopeMostRatedLastMonth(Builder $query): Builder
    {
    return $query->MostRated(now()->subMonth(), now())
    ->Popular(now()->subMonth(), now())
    ->MinReviews(2);
    }


    public function scopeMostRatedLastSixMonth(Builder $query): Builder
    {
    return $query->MostRated(now()->subMonths(6), now())
    ->Popular(now()->subMonths(6), now())
    ->MinReviews(3);
    }



}
//Example querries
// Movie::MostRated('2000-01-01','2023-05-31')->popular('2000-01-01','2023-05-31')->MinReviews(5)->get();