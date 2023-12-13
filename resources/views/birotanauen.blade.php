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
    <a href="{{ url('/technews') }}" class="menu-item">Tech+жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан әуені</a>
</header>

<main>

<div class="videos-list">
    @if(isset($videos))
        @foreach($videos as $video)
            <div class="video-item">
                <div class="video-thumbnail">
                    <iframe src="{{ str_replace('watch?v=', 'embed/', $video->youtube_link) }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    {{--                    <img src="{{ $video->getYouTubeThumbnailUrl($video->youtube_link) }}" alt="{{ $video->title }}">--}}
                </div>
                <div class="video-info">
{{--                    <h3 class="video-title">{{ $video->title }}</h3>--}}
{{--                    <div class="video-meta">--}}
{{--                        <p>{{ \Carbon\Carbon::parse($video->publication_date)->format('d/m/Y') }}</p>--}}
{{--                        <p>{{ $video->author_name }}</p>--}}
{{--                        <p>{{ $video->description }}</p>--}}
{{--                    </div>--}}
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
</main>
</body>

{{--@include('footer')--}}

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: tan;
        overflow: hidden;
        height: 100%; /* Full height for the scrollable body */
    }

    html {
        height: 100%; /* Full height for the scrollable body */
        margin: 0;
        padding: 0;
        overflow: hidden; /* Prevent the main scrollbar */
    }

    main {
        /*padding-top: 70px; !* Account for the fixed header *!*/
        /*padding-bottom: 200px;*/
        background-color: tan;
        padding-top: 70px; /* This should be equal or more than the header's height */
        height: calc(100% - 70px); /* Remaining height, assuming header is 70px tall */
        overflow-y: auto; /* Enable scrolling for the main content */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling for touch devices */
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px 0;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        position: fixed; /* Fix the header at the top */
        top: 0;
        left: 0;
        width: 100%; /* Full width */
        z-index: 100; /* Ensure it's above other content */
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
        white-space: nowrap; /* Prevents the text from wrapping */
        overflow: hidden; /* Keeps the content from spilling out */
        text-overflow: ellipsis; /* Adds an ellipsis if the text is too long to fit */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: #2A0FA9;
        margin: 0 20px;
        font-size: 25px;
        font-weight: bold;
    }

    .menu-item img {
        max-width: 100%; /* Ensures the image is not bigger than the container */
        height: auto; /* Maintains the aspect ratio */
        width: auto; /* Sets the image width to auto */
        /*height: auto; !* Sets the image height to auto *!*/
        max-height: 90px; /* Adjust the max-height to match the surrounding elements */
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

    .videos-list {
        margin-top: 50px;
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Creates two columns */
        grid-gap: 20px; /* Adjust the gap as needed */
        padding: 20px;
        /* If you want a fixed height with scrolling, uncomment these */
        /* height: 500px; */
        /* overflow-y: scroll;*/
    }

    .video-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        /*margin: 20px;*/
        margin-bottom: 20px;
        border-radius: 4px;
        overflow: hidden;
        font-family: Arial, sans-serif;
        /* Set width to 100% for responsive design, or set a fixed width */
        width: 100%; /* Full width of the column */
        position: relative; /* Establish a positioning context */
        /*width: 100%; !* Full width of the grid column *!*/
        /*padding-top: 56.25%; !* Aspect ratio padding hack (16:9 aspect ratio) *!*/
    }

    .video-thumbnail {
        position: relative; /* Position absolutely inside .video-item */
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        height: 100%;
        width: 100%;
        padding-top: 56.25%; /* 16:9 aspect ratio, adjust if your aspect ratio is different */
        /*position: relative;*/
        overflow: hidden; /* Hide anything outside the bounds */
    }

    .video-thumbnail iframe {
        width: 100%; /* Full width of the video-item */
        /* Maintain the aspect ratio of 16:9 for the iframe */
        height: 100%;
        position: absolute; /* Position absolutely to fill the parent */
        top: 0;
        left: 0;
    }

    .video-info {
        /*padding: 10px; !* Adds padding inside the video info area *!*/
        display: flex;
        flex-direction: column; /* Stack the title and meta information */
        justify-content: center; /* Center the content vertically */
        /*width: 100%; !* Ensure info section takes full width of .video-item *!*/
        /*padding: 10px; !* Add padding for spacing *!*/
        /*text-align: center; !* Center-align the text *!*/
        padding: 10px 0;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
    }

    .video-title {
        margin-right: 2px; /* Removes default margin */
        color: #333; /* Dark text for title */
        font-size: 18px; /* Larger font size for the title */
        font-weight: bold; /* Makes the title bold */
    }

    .video-meta {
        /*font-size: 14px; !* Smaller font size for meta information *!*/
        /*color: #666; !* Lighter text for meta information *!*/
        /*display: flex; !* This will keep your items in line *!*/
        flex-wrap: wrap; /* Allows the items to wrap to the next line if needed */
        justify-content: center; /* Center the content */
        align-items: baseline; /* Aligns items along the baseline for a consistent look */
        gap: 4px; /* Adds a small space between your spans, adjust as needed */
        display: block; /* Change from flex to block if you want the text underneath and centered */
        color: #333;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }

    .video-meta span {
        white-space: nowrap; /* Prevents breaking the span into multiple lines */
        color: #2A0FA9; /* Dark text for title */
        font-size: 18px; /* Larger font size for the title */
        font-weight: bold; /* Makes the title bold */
        display: inline; /* Keep these inline for proper formatting */
        /*white-space: nowrap;*/
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
