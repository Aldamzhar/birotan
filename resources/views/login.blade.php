<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            /*background-color: #ffffff; !* You can change this to your page's background color *!*/
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: tan;
        }
        .card-body {
            padding: 2em;
            background-color: #ffffff;
        }

        .card {
            width: 100%;
            max-width: 400px; /* Adjust the width of the card */
            margin: auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 8px;
        }
        .card-header {
            background-color: #f8f9fa; /* Light grey background */
            color: #495057; /* Dark grey text */
            padding: 16px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px; /* Aligns header background with card edges */
            font-size: 24px; /* Large text size */
            text-align: center;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            /*margin-bottom: 20px; !* Spacing between form groups *!*/
        }
        .btn-primary {
            background-color: #ffc107; /* Bootstrap yellow */
            border-color: #ffc107;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-secondary {
            background-color: #e9ecef; /* Light grey background */
            border-color: #e9ecef;
            color: #495057; /* Dark grey text */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 10px 24px; /* Larger padding for buttons */
            font-size: 16px; /* Larger font size for buttons */
            margin-right: 8px; /* Spacing between buttons */
        }
        .form-group label {
            /*display: block;*/
            /*margin-bottom: 1rem; !* Adjust the space between the label and the input *!*/
        }

        input[type="email"], input[type="password"] {
            display: block;
            width: 100%; /* Make input full width */
            padding: 3px;
            margin-top: 1rem; /* Space above the input */
            margin-bottom: 1rem; /* Space below the input */
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
    </style>
</head>
<body>
<div class="card">
    <div class="card-header">Біротан Лексика PRO</div>
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
                    Войти
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
