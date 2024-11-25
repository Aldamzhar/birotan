<body>
@include('title')
@include('header')
<main>
    <div class="books-container">
        @if(isset($books) && $books->count())
            @foreach($books as $book)
                <div class="book-item">
                    <div class="book-text">
                        <h2 class="book-title">{{ $book->title }}</h2>
                        <p class="book-meta">
                            Цена: ${{ $book->price }}
                        </p>
                        <p class="book-description">
                            Описание: {{ $book->description }}</p>
                        <div class="book-buttons">
                            <a href="{{ route('books.preview', $book->id) }}" class="btn-preview">Preview</a>
{{--                            <form method="POST" action="{{ route('books.buy', $book->id) }}" class="btn-buy-form">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn-buy">Buy the Book</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No books found.</p>
        @endif
    </div>


    <!-- Pagination Links -->
    <div class="pagination-container">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
</main>
</body>

<style>
    body {
        font-family: Inter, serif;
        margin: 0;
        padding: 0;
        background-color: white; /* Gold background */
    }

    .header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        color: #ffffff;
    }

    .header-title h2 {
        margin: 0;
    }

    .books-container {
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .book-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #d4d6d6; /* Light grey background */
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .book-text {
        flex: 1;
        padding-left: 20px;
    }

    .book-title {
        margin: 0 0 10px;
        font-size: 1.5em;
        color: #0d2945;
    }

    .book-title a {
        color: #0d2945;
        text-decoration: none;
    }

    .book-meta {
        color: #666666;
        margin-bottom: 10px;
    }

    .book-description {
        color: #333333;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        justify-content: center; /* Centers the pagination items */
        width: 100%; /* Makes sure the pagination takes the full width of the container */
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a, .pagination li span {
        padding: 8px 12px;
        text-decoration: none;
        background-color: rgb(20,40,67); /* Gold background */
        color: #ffffff;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .pagination li a:hover, .pagination li span:hover {
        background-color: rgb(20,40,67); /* White background on hover */
        color: #c8985d; /* Gold text on hover */
    }

    .pagination .active a, .pagination .active span {
        background-color: #c8985d; /* Black background for active page */
        color: #ffffff; /* White text for active page */
    }

</style>
