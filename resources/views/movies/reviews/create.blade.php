<x-layout>

    <x-slot:title>
        Add New Review
        </x-slot>

        <div class="max-w-screen-lg mx-auto">

            <h1 class="mb-10 text-2xl">Add Review for {{ $movie->title }}</h1>

            <form method="POST" action="{{ route('movies.reviews.store', $movie) }}">
                @csrf
                <label for="comment">Review</label>
                <textarea name="comment" id="comment" class="input mb-4"></textarea>
                @error('comment')
                <div class="text-rose-500 text-sm">{{ $message }}</div>
                @enderror
                <label for="rating">Rating</label>

                <select name="rating" id="rating" class="input mb-4">
                    <option value="">Select a Rating</option>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
                @error('rating')
                <div class="text-rose-500 text-sm">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn">Add Review</button>
            </form>
        </div>


</x-layout>