<header>
    <div class="logo">
        <a href="{{url('/mypage')}}"><img src="{{\Illuminate\Support\Facades\Storage::disk()->url("img_10.png")}}" alt="BirOtan Logo"></a>
    </div>
    <nav>
        <a href="{{ url('/about') }}" class="menu-item"><u>Сайт туралы</u></a>
        <div class="dropdown">
            <a href="{{ url('/birotanlex') }}" class="menu-item"><u>БірОтан лексика</u></a>
            <div class="dropdown-content">
                <a href="{{ url('/birotanlex-pro') }}" class="menu-item"><u>БірОтан лексика.pro</u></a>
            </div>
        </div>
        <a href="{{ url('/technews') }}" class="menu-item"><u>Tech+жаңалық</u></a>
        <a href="{{ url('/birotanauen') }}" class="menu-item"><u>БірОтан әуені</u></a>
        <a href="{{ url('/books') }}" class="menu-item"><u>Кітаптар</u></a>
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="dropdown">
                <a href="{{ url('/profile') }}" class="menu-item"><u>Профиль</u></a>
                <div class="dropdown-content">
                    <form method="POST" action="{{ route('user.logout') }}" id="logout-form">
                        @csrf
                        <button type="submit" class="menu-item" style="background: none; border: none; cursor: pointer;">
                            <u>Шығу</u>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ url('/user-login') }}" class="menu-item"><u>Логин/Регистрация</u></a>
        @endif
    </nav>
</header>

<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px 40px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
        gap: 60px;
        flex-grow: 1;
        justify-content: flex-end;
    }

    .menu-item {
        font-family: Inter, serif;
        color: var(--navy-blue);
        font-size: 16px;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        padding-bottom: 0;
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
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
