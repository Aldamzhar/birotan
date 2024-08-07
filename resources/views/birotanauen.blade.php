<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="{{\Illuminate\Support\Facades\Storage::disk()->url("img_4.png")}}">
    <title>BirOtan</title>
</head>
<body>
@include('title')
@include('header')

<main>
{{--    <div class="header-title">--}}
{{--        <h2>БірОтан әуені</h2>--}}
{{--    </div>--}}
    <div class="videos-list">
        @if(isset($videos))
            @foreach($videos as $video)
                <div class="video-item">
                    <div class="video-thumbnail">
                        <iframe src="{{ str_replace('watch?v=', 'embed/', $video->youtube_link) }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <p class="video-meta">
                            <span class="video-title">{{ $video->title }},</span>
                            <span>{{ $video->author_name }}</span>
                            <span>/ {{ \Carbon\Carbon::parse($video->publication_date)->format('d.m.Y') }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No videos found.</p>
        @endif
    </div>

    <!-- Pagination Links -->
    <div class="pagination-container">
        {{ $videos->links('pagination::bootstrap-4') }}
    </div>
</main>
</body>
</html>


<style>
    body {
        font-family: Inter, serif;
        margin: 0;
        padding: 0;
        background-color: rgb(191,147,86); /* Gold background */
        height: 100vh; /* Full height for the viewport */
        display: flex;
        flex-direction: column;
    }

    header {
        flex: 0 0 auto;
    }

    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .videos-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Creates three columns */
        grid-gap: 20px;
        padding: 20px;
        box-sizing: border-box;
        overflow: auto; /* Allow scrolling within the grid if needed */
    }

    .video-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 4px;
        overflow: hidden;
        font-family: Inter, serif;
        background-color: rgba(0, 0, 0, 0.3);
        margin: 0;
    }

    .video-thumbnail {
        position: relative;
        padding-top: 56.25%; /* 16:9 aspect ratio */
        overflow: hidden;
        width: 100%;
    }

    .video-thumbnail iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .video-info {
        padding: 10px 0;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
    }

    .video-meta {
        display: block;
        color: #ffffff;
        font-size: 0.90em;
        text-align: center;
        margin-top: 10px;
    }

    .video-meta span {
        display: inline;
        white-space: nowrap;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding: 10px;
        flex: 0 0 auto;
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
        background-color: #c8985d; /* Gold background */
        color: #ffffff;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .pagination li a:hover, .pagination li span:hover {
        background-color: #ffffff; /* White background on hover */
        color: #c8985d; /* Gold text on hover */
    }

    .pagination .active a, .pagination .active span {
        background-color: #000000; /* Black background for active page */
        color: #ffffff; /* White text for active page */
    }

</style>
