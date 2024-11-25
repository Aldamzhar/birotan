<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логин</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #4a75a8;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background-color: #e0ebf5;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 25px;
        }

        .card-header {
            font-size: 24px;
            color: #4a75a8;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #4a75a8;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"], input[type="password"] {
            width: 92%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #4a75a8;
            box-shadow: 0 0 5px rgba(74, 117, 168, 0.4);
        }

        .btn-primary {
            background-color: #4a75a8;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #3a5d8a;
        }

        .text-link {
            color: #4a75a8;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
            display: block;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="card-header">Логин</div>
    <form method="POST" action="{{ route('log.the.user') }}">
        @csrf
        <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-primary">Войти</button>
    </form>
    <a href="{{ route('user.register.page') }}" class="text-link">Нет аккаунта? Зарегистрируйтесь тут</a>
</div>
</body>
</html>
