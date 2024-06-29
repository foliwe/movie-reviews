<x-layout>
    <x-slot:title>
        Reviews
        </x-slot>
        <div class="max-w-screen-xl mx-auto">
            <form method="GET" action="{{route('movies.index')}}" class="flex items-center py-10 space-x-2">
                <input class="input h-12" type="text" name="title" value="{{request('title')}}"
                    placeholder="Search by title">
                <input type="hidden" name="filter" value="{{request('filter')}}">
                <button class="btn h-10" type="submit">Search</button>
                <a href="{{route('movies.index')}}">Clear</a>
            </form>

            <div class="filter-container mb-4 flex">
                @php
                $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
                ];
                @endphp

                @foreach ($filters as $key => $label)
                <a href="{{route('movies.index',[...request()->query(),'filter'=> $key])}}"
                    class="{{request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item'}}">
                    {{ $label }}
                </a>
                @endforeach
            </div>

            <ul>
                @forelse ($movies as $movie)

                <li class="mb-4">

                    <div class="movie-item">

                        <div class="flex  flex-wrap items-center justify-between shadow-md my-1 py-2 rounded-md px-3">

                            <div class="w-full flex-grow sm:w-auto ">
                                <a href="{{route('movies.show', $movie)}}" class="movie-title">{{ $movie->title }}</a>
                                <span class="movie-author text-sm"> {{ $movie->genre }}</span>
                            </div>

                            <div>
                                <div class="movie-rating flex flex-col justify-center items-center">
                                    <span class="text-sm">{{number_format($movie->reviews_avg_rating, 1)
                                        }}</span>
                                    <x-star-rating :rating="$movie->reviews_avg_rating" />

                                </div>
                                <div class="movie-review-count">
                                    out of {{ $movie->reviews_count }} {{ Str::plural('review', $movie->reviews_count)
                                    }}
                                </div>
                            </div>
                        </div>

                    </div>

                </li>
                @empty
                <li class="mb-4">
                    <div class="empty-movie-item">
                        <p class="empty-text">No movies found</p>
                        <a href="{{ route('movies.index') }}" class="reset-link">Reset criteria</a>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>




</x-layout>