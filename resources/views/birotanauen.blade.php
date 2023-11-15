<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Website</title>
</head>

<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
    <a href="{{ url('/mypage') }}"><img src="/storage/img_4.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech + жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан өуені</a>
</header>
<body>

<div class="videos-list">
    @if(isset($videos['items']))
        @foreach($videos['items'] as $video)
            <div class="video-item">
                <div class="video-thumbnail">
                    <img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}">
                </div>
                <div class="video-info">
                    <h3 class="video-title">{{ $video['snippet']['title'] }}</h3>
                    <div class="video-meta">
                        <span class="video-channel">{{ $video['snippet']['channelTitle'] }}</span>
{{--                        <span class="video-duration">{{ gmdate('i:s', $video['contentDetails']['duration']) }}</span> --}}{{-- Duration needs conversion --}}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No videos found.</p>
    @endif
</div>

</body>

@include('footer')

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: tan;

    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px 30px;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
    }

    .menu-item {
        text-decoration: none;
        color: #444;
        margin: 0 10px;
        font-size: 14px;
    }

    h1 {
        font-size: 35px;
        color: #0277BD; /* Change this color to match your design */
        margin: 0;
    }

    .menu-item:hover {
        text-decoration: underline;
    }
    .main-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .news-container {
        width: 100%;
        max-width: 1200px; /* Adjust to your preferred max width */
        margin-top: 20px;
        /*margin: 0 auto; !* Center the container *!*/
    }

    .news-item {
        display: flex;
        align-items: center; /* Align items vertically */
        margin-bottom: 20px; /* Space between news items */
        padding: 10px; /* Padding around news items */
        /*background: #f9f9f9; !* Background color for the news item *!*/
        border-radius: 5px; /* Rounded corners for the news item */
    }

    .news-image {
        flex: 0 0 150px; /* Adjust width as necessary */
        height: 100px; /* Adjust height as necessary */
        margin-right: 20px; /* Space between image and text */
        overflow: hidden; /* In case the image is too big */
    }

    .news-image img {
        width: 100%;
        height: auto;
        object-fit: cover; /* Ensures the image covers the area */
    }

    .news-text {
        flex-grow: 1; /* Ensure text takes up the remaining space */
    }

    .news-title {
        margin: 0;
        font-size: 1.2em; /* Adjust font size as necessary */
        color: #444; /* Title text color */
    }

    .news-meta {
        font-size: 0.9em; /* Adjust font size as necessary */
        color: #666; /* Meta text color */
    }

    .news-description {
        font-size: 1em; /* Adjust font size as necessary */
        color: #333; /* Description text color */
    }

    .videos-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .video-item {
        width: 250px; /* You can adjust the width as needed */
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }
    .video-thumbnail img {
        width: 100%;
        display: block;
    }
    .video-info {
        padding: 10px;
    }
    .video-title {
        font-size: 16px;
        margin: 0 0 10px;
    }
    .video-meta {
        font-size: 14px;
        color: #666;
    }


    /* Add other styles as needed */
    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }

    .pagination > li {
        display: inline;
    }

    .pagination > li > a,
    .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .pagination > li:first-child > a,
    .pagination > li:first-child > span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .pagination > li:last-child > a,
    .pagination > li:last-child > span {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .pagination > li > a:hover,
    .pagination > li > span:hover,
    .pagination > li > a:focus,
    .pagination > li > span:focus {
        color: #23527c;
        background-color: #eee;
        border-color: #ddd;
    }

    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:hover,
    .pagination > .active > span:hover,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .pagination > .disabled > span,
    .pagination > .disabled > span:hover,
    .pagination > .disabled > span:focus,
    .pagination > .disabled > a,
    .pagination > .disabled > a:hover,
    .pagination > .disabled > a:focus {
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }

    /* Additional styling */
    .pagination > li > a:focus, .pagination > li > a:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pagination > .active > a {
        background-color: #007bff;
        border-color: #007bff;
    }


</style>
