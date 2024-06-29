@include('title')
<body>
<div class="card">
    <div class="card-header">БірОтан лексика PRO</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Логин</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Кіру
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Оралу</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: Inter, sans-serif;
        background-color: #4a75a8;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        width: 100%;
        max-width: 400px;
        margin: auto;
        padding: 35px;
        border-radius: 8px;
        background-color: #e0ebf5;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #e0ebf5;
        color: #4a75a8;
        padding: 16px;
        border-radius: 8px 8px 0 0;
        font-size: 24px;
        text-align: center;
        font-weight: bold;
    }

    .btn {
        padding: 10px 24px;
        font-size: 16px;
        margin-top: 1.5rem;
    }

    .form-group label {
        font-size: 14px;
        color: #4a75a8;
    }

    input[type="email"], input[type="password"] {
        width: 100%;
        margin-top: 0.5rem; /* Space above the input */
        margin-bottom: 0.5rem; /* Increased space below the input */
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 16px;
        font-family: Inter, sans-serif;
    }

    input[type="email"]::placeholder, input[type="password"]::placeholder {
        font-family: Inter, sans-serif;
    }

    input[type="email"]:focus, input[type="password"]:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }

    .btn-primary {
        background-color: #223f69;
        border-color: #223f69;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-family: Inter, sans-serif;
        padding: 10px 24px;
        font-size: 16px;
    }

    .btn-secondary {
        background-color: #a3c1dd;
        border-color: #a3c1dd;
        color: #4a75a8;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-family: Inter, sans-serif;
        padding: 10px 24px;
        font-size: 16px;
        margin-left: 95px;
    }

    .btn:hover {
        opacity: 0.8;
    }

</style>
