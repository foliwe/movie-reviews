<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $title = $request->input('title');
        $filter = $request->input('filter','');

        $movies = Movie::when(
            $title, function($query, $title){
            return $query->Title($title);
        });

        $movies = match ($filter) {
            'popular_last_month' => $movies->PopularLastMonth(),
            'popular_last_6months' => $movies->PopularLastSixMonth(),
            'highest_rated_last_month' => $movies->MostRatedLastMonth(),
            'highest_rated_last_6months' => $movies->MostRatedLastSixMonth(),
            default => $movies->latest()->WithReviewCount()->WithAverageRating()
        };


        $movies = $movies->get();
    //     $cacheKey = 'movies:' . $filter . ':' . $title;
    //    $movies = cache()->remember($cacheKey, 3600, fn() => $movies->get());

        return view('movies.index', ['movies' => $movies]);
    }


    public function show(Movie $movie)
    {

        $movie = Movie::withReviewCount()
        ->withAverageRating()
        ->with(['reviews' => fn($query) => $query->latest()])
        ->findOrFail($movie->id);



        return view('movies.show',['movie' =>$movie]);

    }


}