<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>BirOtan</title>
</head>


<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech + жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан өуені</a>
</header>
<body>
<video autoplay muted loop id="myBackgroundVideo">
    <source src="{{ asset('storage/background.mp4') }}" type="video/mp4">
</video>
</body>





</html>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0; /* Account for the fixed header */
        height: 100vh;
        overflow: hidden; /* Hide scrollbars */
    }

    #myBackgroundVideo {
        position: fixed; /* Fixed or absolute depending on your layout */
        top: 50px; /* Height of the header */
        left: 0;
        width: 100vw; /* Set width to viewport width */
        height: calc(100vh - 50px); /* Adjust height taking into account the header */
        object-fit: cover; /* Cover the entire area without losing aspect ratio */
        z-index: -100; /* Ensure video stays in the background */
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

    .menu-item img {
        max-width: 100%; /* Ensures the image is not bigger than the container */
        height: auto; /* Maintains the aspect ratio */
        width: auto; /* Sets the image width to auto */
        /*height: auto; !* Sets the image height to auto *!*/
        max-height: 50px; /* Adjust the max-height to match the surrounding elements */
        vertical-align: top; /* Aligns the image with the top of the line */
    }

    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /*padding: 10px;*/
        padding: 0;
        background-color: white;
        color: #000;
        font-family: Arial, sans-serif;
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        /*height: 100px; !* Set the footer height *!*/
    }


</style>
