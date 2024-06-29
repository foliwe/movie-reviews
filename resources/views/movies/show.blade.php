<x-layout>
    <x-slot:title>
        {{ $movie->title }}
        </x-slot>
        <div class="max-w-screen-xl mx-auto">
            <div class="sticky top-1 mb-2  py-3 flex p-3 bg-gray-100 items-center justify-between">
                <div class=" flex  justify-center items-center gap-5">
                    <div class="flex flex-col justify-between items-stretch h-32">
                        <h1 class="  text-3xl ">{{ $movie->title }}</h1>
                        <div class="">
                            <a href="{{route('movies.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg> back
                            </a>
                        </div>
                    </div>

                    <div class="book-info ">
                        <div class="flex items-center">
                            <div
                                class="mr-2 text-sm font-medium text-slate-700 flex flex-col justify-center items-center">
                                <span>{{ number_format($movie->reviews_avg_rating, 1) }}</span>
                                <x-star-rating :rating="$movie->reviews_avg_rating" />
                                <span class="text-sm text-gray-500">{{ $movie->reviews_count }} {{ Str::plural('review',
                                    $movie->reviews_count) }}</span>
                            </div>
                            {{-- <span class="book-review-count text-sm text-gray-500">

                            </span> --}}
                        </div>
                    </div>
                </div>
                <div class="">
                    <a class="text-teal-500 underline" href="{{route('movies.reviews.create', $movie)}}"> Add Review</a>
                </div>


            </div>
            <div class="mb-4">

            </div>

            <div>
                <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
                <ul>
                    @forelse ($movie->reviews as $review)
                    <li class="book-item mb-4">
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <div class="font-semibold">
                                    <x-star-rating :rating="$review->rating" />
                                </div>
                                <div class="book-review-count">
                                    {{ $review->created_at->format('M j, Y') }}</div>
                            </div>
                            <p class="text-gray-700">{{ $review->comment }}</p>
                        </div>
                    </li>
                    @empty
                    <li class="mb-4">
                        <div class="empty-book-item">
                            <p class="empty-text text-lg font-semibold">No reviews yet</p>
                        </div>
                    </li>
                    @endforelse
                </ul>

            </div>

        </div>
</x-layout>