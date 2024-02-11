<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <a href="{{ url('/birotanlex-pro') }}" class="menu-item">БірОтан лекс-PRO</a>
        </div>
    </div>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech+Жаңалық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан әуені</a>
</header>
<body>
<video autoplay muted loop id="myBackgroundVideo">
    <source src="{{ asset('storage/Background.mp4') }}" type="video/mp4">
</video>
{{--<div id="textBox" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); color: #FFFFFF; text-shadow: 5px 5px 3px #2A0FA9; font-size: 2em; font-weight: bold; font-family: 'Arial', sans-serif; background-color: rgba(0, 0, 0, 0); padding: 10px;">--}}
{{--    Бір ел, Бір ұлт, Бір мақсат!--}}
{{--</div>--}}
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
        padding: 10px 0;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
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

    h1 {
        font-size: 35px;
        color: #0277BD; /* Change this color to match your design */
        margin: 0;
    }

    .menu-item:hover {
        text-decoration: underline;
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
