<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;

class ReviewController extends Controller

{
    // public function __construct()
    // {
    //     $this->middleware('throttle:reviews')->only(['store']);
    // }


    public function create(Movie $movie)
    {
        return view('movies.reviews.create',['movie' => $movie]);
    }



    public function store(Request $request, Movie $movie)
        {
            $data = $request->validate([
                'comment'=> 'required|min:5|max:150',
                'rating' => 'required|min:1|max:5|integer'
            ]);

            $movie->reviews()->create($data);
            return to_route('movies.show', $movie);
        }
}