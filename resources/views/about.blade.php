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
    <!-- Your content here -->
    <section class="content-section">
        <div class="content-box">
            <img src="{{ asset('storage/img_1.png') }}">
            <p>Birotan.kz сайты үздік қазақтілді ақпараттық, ғылыми-танымдық мазмұндағы ресурс ұсыну мақсатымен жасалды. Сайтта әлемдегі және еліміздегі басты технологиялық жаңалықтар жарияланады.
            </p>
        </div>
        <div class="content-box">
            <img src="{{ asset('storage/img_2.png') }}">
            <p>«БірОтан лексика» – ғылыми-ағартушылық жоба.
                Еліміздің белгілі медиа мен IT саласының мамандарының жігерімен жүзеге асырылған ғылыми сервис қазақ тіліндегі мәтіндердегі сөз байлығын талдауға арналған.
            </p>
        </div>
        <div class="content-box">
            <img src="{{ asset('storage/img_3.png') }}">
            <p>Ғылыми жобаның бағдарламалық қамтылымын кәсіби мамандармен бірлесіп жасауға қатысқан Назарбаев университетінің магистранттары
                Бегім Құтым мен
                Алдамжар Киікбаевқа, басқа да кеңесші инженерлерге алғыс білдіреміз.
            </p>
        </div>
    </section>
</main>
</body>

@include('footer')

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;

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

    h1 {
        font-size: 35px;
        color: #0277BD; /* Change this color to match your design */
        margin: 0;
    }

    .menu-item:hover {
        text-decoration: underline;
    }

    main {
        padding-top: 70px; /* Account for the fixed header */
        padding-bottom: 85px;
        background-color: tan;
    }

    .content-section {
        display: flex;
        justify-content: center;
        padding: 20px;
        background-color: tan;
    }

    .content-box {
        width: 33%; /* Splitting it into thirds */
        box-sizing: border-box;
        display: flex; /* Using flexbox to center contents */
        flex-direction: column; /* Stacking contents vertically */
        align-items: center; /* Horizontal centering */
        justify-content: center; /* Vertical centering */
    }

    .content-box img {
        width: 175px;  /* Set the desired width */
        height: 175px; /* Set the desired height */
        /*object-fit: cover;*/
        display: block;
        margin-bottom: 15px; /* Add some space between the image and text */
    }

    .content-box p {
        text-align: center; /* Centering the text below the image */
        max-width: 90%; /* To ensure the text doesn't stretch too wide */
        color: #0277BD;
    }


</style>
