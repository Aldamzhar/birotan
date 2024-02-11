<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="/storage/img_4.png">
    <title>BirOtan</title>
</head>

<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <div class="dropdown">
        <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
        <div class="dropdown-content">
            <a href="{{ url('/birotanlex-pro') }}" class="menu-item">БірОтан лекc-pro</a>
        </div>
    </div>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech+Жаңалық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан әуені</a>
</header>
<body>
<div class="main-container">
    <div class="news-container">
        @foreach ($newsItems as $article)
            <div class="news-item">
                <div class="news-image">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($article['img']) }}" alt="{{ $article['title'] }}">
                </div>
                <div class="news-text">
                    <h2 class="news-title">
                        <a href="{{ $article['link'] }}" target="_blank">{{ $article['title'] }}</a>
                    </h2>
                    <p class="news-meta">{{ (new DateTime($article['publication_date']))->format('d/m/Y') }} | {{ $article['author_name'] }}</p>
                    <p class="news-description">{{ $article['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>

{{--@include('footer')--}}

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
        padding: 10px 0;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
    }



    /* Style the dropdown container */
    .dropdown {
        display: inline-block;
    }

    /* Style the dropdown button */
    .dropbtn {
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
        margin: 0 10px;
        font-size: 25px;
        font-weight: bold;
    }

    /* Dropdown content (hidden by default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white; /* Light grey background */
        /*z-index: 1;*/
    }

    /* Links inside the dropdown */
    .dropdown-content a {
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
        margin: 0 10px;
        font-size: 25px;
        font-weight: bold;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: white}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: white; /* Darker green */
    }


    h1 {
        font-size: 35px;
        color: #0277BD; /* Change this color to match your design */
        margin: 0;
    }

    .news-title a {
        color: #2A0FA9;
        cursor: pointer;
        text-decoration: underline;
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
        margin: 0 10px;
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

    .menu-item:hover {
        text-decoration: underline;
    }
    .main-container {
        display: flex; /* Use flexbox for layout */
        justify-content: space-between; /* Space between the two main columns */
        align-items: flex-start; /* Align columns to the start of the cross axis */
        max-width: 1200px; /* Maximum width of the container */
        margin: 20px auto; /* Center the container with margin */
        padding: 20px; /* Padding around the container */
    }

    .news-container {
        display: flex; /* Use flexbox for layout */
        flex-direction: column; /* Stack children vertically */
        width: 100%; /* Full width of the container */
    }

    .news-item {
        display: flex; /* Use flexbox for layout within each news item */
        /*justify-content: space-between; !* Space between image and text *!*/
        margin-bottom: 20px; /* Margin between news items */
    }

    .news-image {
        width: 35%; /* Width of the image container */

        /*height: 48%;*/
        margin-right: 4%; /* Space between image and text */
    }

    .news-image img {
        width: 100%; /* Make image use up all available space */
        height: auto; /* Keep image aspect ratio */
        object-fit: cover; /* Cover the space without stretching */
    }

    .news-text {
        width: 48%; /* Width of the text container */
    }

    .news-title {
        margin: 0 0 10px 0; /* Margin below the title */
        font-size: 1.5em; /* Larger font size for the title */
    }

    .news-meta {
        color: black; /* Darker color for meta text */
        margin: 0 0 10px 0; /* Margin below the meta text */
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
