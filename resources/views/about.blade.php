<body>
@include('title')
@include('header')
            <section class="content-section">
                <div class="content-box box1">
                    <img src="{{ asset('storage/img_1.png') }}" alt="Image 1">
                    <p>Birotan.kz сайты үздік қазақтілді ақпараттық, ғылыми-танымдық мазмұндағы ресурс ұсыну мақсатымен жасалды. Сайтта әлемдегі және еліміздегі басты технологиялық жаңалықтар жарияланады.</p>
                </div>
                <div class="content-box box2">
                    <img src="{{ asset('storage/img_2.png') }}" alt="Image 2">
                    <p>«БірОтан лексика» – ғылыми-ағартушылық жоба. Еліміздің белгілі медиа мен IT саласының мамандарының жігерімен жүзеге асырылған ғылыми сервис қазақ тіліндегі мәтіндердегі сөз байлығын талдауға арналған.</p>
                </div>
                <div class="content-box box3">
                    <img src="{{ asset('storage/img_3.png') }}" alt="Image 3">
                    <p>Ғылыми жобаның бағдарламалық қамтылымын кәсіби мамандармен бірлесіп жасауға қатысқан Назарбаев университетінің магистрлары мен басқа да кеңесші инженерлерге алғыс білдіреміз.</p>
                </div>
            </section>
</body>

@include('footer')


<style>
    body {
        font-family: 'Inter', serif;
        margin: 0;
        padding: 0;
        background-color: #345987;
    }

    main {
        padding-top: 70px; /* Account for the fixed header */
    }

    .content-section {
        display: flex;
        justify-content: space-around;
        padding: 0;
        margin: 0;
    }

    .content-box {
        flex: 1;
        box-sizing: border-box;
        padding: 40px;
        text-align: center;
        color: var(--white);
    }

    .box1 {
        background-color: #1E3A5F;
    }

    .box2 {
        background-color: #27476E;
    }

    .box3 {
        background-color: #345987;
    }

    .content-box img {
        width: 150px;
        height: 150px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .content-box p {
        text-align: center;
        max-width: 90%;
        color: white;
        font-size: 1em;
        line-height: 1.5;
    }

</style>
