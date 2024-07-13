<body>
@include('title')
@include('header')

<div class="background" style="position: relative; width: 100%; height: calc(100vh - 60px); overflow: hidden;">
    <img src="{{ asset('storage/background.png') }}" alt="Background Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">
    <div class="overlay" style="position: relative; text-align: left; margin-left: -25%;">
        <h1 style="font-size: 6em; color: #0D2945; margin: 0.1em 0;"><span class="gold" style="color: #c8985d;">Бір</span> ел,</h1>
        <h1 style="font-size: 6em; color: #0D2945; margin: 0.1em 0;"><span class="gold" style="color: #c8985d;">Бір</span> ұлт,</h1>
        <h1 style="font-size: 6em; color: #0D2945; margin: 0.1em 0;"><span class="gold" style="color: #c8985d;">Бір</span> мақсат!</h1>
        <a href="{{ url('/about') }}"><button style="margin-left: 120%; padding: 1em 2.5em; font-size: 1em; font-weight: bold; color: white; background-color: #0D2945; border: none; border-radius: 25px; cursor: pointer; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: 'Montserrat Alternates', serif; text-transform: uppercase;">Көбірек білу</button></a>
    </div>
</div>
</body>

<style>

    :root {
        --navy-blue: #0D2945;
        --gold: #c8985d;
    }

    body {
        font-family: "Montserrat Alternates", serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;
    }

    .background {
        position: relative;
        width: 100%;
        height: calc(100vh - 60px); /* Adjust according to header height */
        background-image: url('/storage/app/public/background.png'); /* Change to your ornament image path */
        background-repeat: repeat;
        background-size: contain;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .overlay {
        position: absolute;
        text-align: left;
        margin-left: -25%;
    }

    .overlay h1 {
        font-size: 6em;
        color: var(--navy-blue);
        margin: 0.1em 0;
    }

    .overlay .gold {
        color: var(--gold);
    }

    .overlay button {
        margin-left: 120%;
        padding: 1em 2.5em;
        font-size: 1em;
        font-weight: bold;
        color: white;
        background-color: var(--navy-blue);
        border: none;
        border-radius: 25px; /* Rounded corners */
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
        font-family: "Montserrat Alternates", serif;
        text-transform: uppercase;
    }

</style>
