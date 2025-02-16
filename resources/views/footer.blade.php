@php use Illuminate\Support\Facades\Storage; @endphp
<footer class="footer">
    <div class="footer-section-first">
        <p>Birotan.kz сайты – қазақтілді ақпараттық, ғылыми-танымдық мазмұндағы ресурс. <br>Сайтта «БірОтан лексика»
            ғылыми-ағартушылық жобасы ұсынылған және әлемдегі, <br>еліміздегі басты технологиялық жаңалықтар
            жарияланады.</p>
        <p><b>© 2023 BirOtan.kz. Барлық құқықтар қорғалған</b></p>
    </div>
    <div class="footer-section-second">
        <p><i>Мекенжайы: 010000, Астана қаласы</i><br>
            <i>Байланыс телефоны: +7 (701) ХХХ ХХХХ</i><br>
            <i>E-mail: info@birotan.kz</i>
        </p>
        <p>
            <a href="{{Storage::disk('public')->url('TipTop_Информация_для_размещения_на_сайте_02_2025.docx')}}"
               target="_blank">
                <i>TipTop информация для размещения на сайте</i>
            </a><br>
            <a href="{{Storage::disk('public')->url('Договор_оферты_и_Политика_конфиденциальности_02_2025.docx')}}"
               target="_blank">
                <i>Договора оферты и политика конфиденциальности</i>
            </a>
        </p>
    </div>
</footer>

<style>
    .footer-img {
       width: 20%;
       height: 20%;
    }

    .footer {
        box-sizing: border-box;
        padding: 20px; /* Adjust padding as needed */
        overflow: hidden; /* or 'auto' if you want a scrollbar */
        width: 100%; /* or any other value that fits your layout */
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        color: #000;
        font-family: Inter, serif;
        font-size: 15px;
        left: 0;
        bottom: 0;
    }

    .footer-section-first {
        display: flex;
        flex-direction: column;
    }

    .footer-section-second {
        white-space: nowrap;
        margin-right: 180px;
    }

    .footer-section-second a {
        color: #007bff;
        text-decoration: none;
    }

    .footer-section-second a:hover {
        text-decoration: underline;
    }
</style>
