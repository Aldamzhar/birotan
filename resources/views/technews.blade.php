@include('title')
@include('header')
<body>
<main>
    <div class="news-container">
        @if(isset($newsItems) && $newsItems->count())
            @foreach($newsItems as $article)
                <div class="news-item">
                    <div class="news-image">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($article->img) }}" alt="{{ $article->title }}">
                    </div>
                    <div class="news-text">
                        <h2 class="news-title">
                            <a href="{{ $article->link }}" target="_blank">{{ $article->title }}</a>
                        </h2>
                        <p class="news-meta">{{ \Carbon\Carbon::parse($article->publication_date)->format('d/m/Y') }} | {{ $article->author_name }}</p>
                        <p class="news-description">{{ $article->description }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No news found.</p>
        @endif
    </div>

    <!-- Pagination Links -->
    <div class="pagination-container">
        {{ $newsItems->links('pagination::bootstrap-4') }}
    </div>
</main>
</body>

{{--@include('footer')--}}

</html>

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

    .news-container {
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .news-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #d4d6d6; /* Light grey background */
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .news-image {
        flex: 0 0 150px;
        height: 150px;
        border-radius: 10px;
        overflow: hidden;
    }

    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .news-text {
        flex: 1;
        padding-left: 20px;
    }

    .news-title {
        margin: 0 0 10px;
        font-size: 1.5em;
        color: #0d2945;
    }

    .news-title a {
        color: #0d2945;
        text-decoration: none;
    }

    .news-meta {
        color: #666666;
        margin-bottom: 10px;
    }

    .news-description {
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
