<header>
    <div class="logo">
        <a href="{{url('/mypage')}}"><img src="/storage/img_10.png" alt="BirOtan Logo"></a>
    </div>
    <nav>
        <a href="{{ url('/about') }}" class="menu-item"><u>Сайт туралы</u></a>
        <div class="dropdown">
            <a href="{{ url('/birotanlex') }}" class="menu-item"><u>БірОтан лексика</u></a>
            <div class="dropdown-content">
                <a href="{{ url('/birotanlex-pro') }}" class="menu-item"><u>БірОтан лекс-PRO</u></a>
            </div>
        </div>
        <a href="{{ url('/technews') }}" class="menu-item"><u>Tech+Жаңалық</u></a>
        <a href="{{ url('/birotanauen') }}" class="menu-item"><u>БірОтан әуені</u></a>
    </nav>
</header>

<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px 40px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }

    header .logo {
        display: flex;
        align-items: center;
    }

    header .logo img {
        height: 60px;
        margin-right: 15px;
    }

    nav {
        display: flex;
        gap: 135px;
        flex-grow: 1;
        justify-content: flex-end;
    }

    .menu-item {
        font-family: Inter, serif;
        color: var(--navy-blue);
        font-size: 16px;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        padding-bottom: 5px;
        position: relative;
    }

    .menu-item:hover {
        border-bottom: 2px solid var(--navy-blue);
    }

    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: lightgray;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        top: 100%;
        left: 0;
        min-width: 220px;
    }

    .dropdown-content .menu-item {
        display: block;
        padding: 16px 36px;
        font-size: 16px;
        border-bottom: none;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

</style>
