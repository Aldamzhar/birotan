<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="/storage/img_4.png">
    <title>BirOtan</title>

</head>

<body>
<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech + жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан өуені</a>
</header>

<main>

<div class="videos-list">
    @if(isset($videos))
        @foreach($videos as $video)
            <div class="video-item">
                <div class="video-thumbnail">
                    <iframe width="360" height="215" src="{{ str_replace('watch?v=', 'embed/', $video->youtube_link) }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
{{--                    <img src="{{ $video->getYouTubeThumbnailUrl($video->youtube_link) }}" alt="{{ $video->title }}">--}}
                </div>
                <div class="video-info">
                    <h3 class="video-title"><a href="{{ $video->youtube_link }}" target="_blank">{{ $video->title }}</a></h3>
                    <div class="video-meta">
                        <p>{{ \Carbon\Carbon::parse($video->publication_date)->format('d/m/Y') }}</p>
                        <p>{{ $video->author_name }}</p>
{{--                        <p>{{ $video->description }}</p>--}}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No videos found.</p>
    @endif
</div>
</main>
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

    main {
        /*padding-top: 70px; !* Account for the fixed header *!*/
        padding-bottom: 200px;
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

    .menu-item {
        display: inline-block; /* Sets the element's display to inline-block */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: black;
        margin: 0 10px;
        font-size: 22px;
        font-weight: bold;
    }

    .menu-item img {
        max-width: 100%; /* Ensures the image is not bigger than the container */
        height: auto; /* Maintains the aspect ratio */
        width: auto; /* Sets the image width to auto */
        /*height: auto; !* Sets the image height to auto *!*/
        max-height: 60px; /* Adjust the max-height to match the surrounding elements */
        vertical-align: top; /* Aligns the image with the top of the line */
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

    .video-item {
        display: flex; /* Align thumbnail and info side by side */
        /*background-color: #fff; !* White background *!*/
        border-radius: 4px; /* Rounded corners */
        overflow: hidden; /* Ensures the content fits within the borders */
        /*box-shadow: 0 2px 5px rgba(0,0,0,0.2); !* Adds a subtle shadow *!*/
        font-family: Arial, sans-serif; /* Sets the font */
        margin: 20px; /* Adds space between video items */
    }

    .video-thumbnail img {
        width: 150px; /* Sets a fixed width for the image */
        height: 100px; /* Sets a fixed height for the image */
        object-fit: cover; /* Ensures the image covers the area */
    }

    .video-info {
        padding: 10px; /* Adds padding inside the video info area */
        display: flex;
        flex-direction: column; /* Stack the title and meta information */
        justify-content: center; /* Center the content vertically */
    }

    .video-title {
        margin: 0; /* Removes default margin */
        color: #333; /* Dark text for title */
        font-size: 18px; /* Larger font size for the title */
        font-weight: bold; /* Makes the title bold */
    }

    .video-meta {
        font-size: 14px; /* Smaller font size for meta information */
        color: #666; /* Lighter text for meta information */
    }

    .video-meta p {
        margin: 5px 0; /* Adds spacing between meta information lines */
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
