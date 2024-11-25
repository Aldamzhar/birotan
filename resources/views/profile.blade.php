<body>
    <div class="profile-container">
        <h2>Профиль</h2>
        <div class="profile-details">
            <p><strong>Аты:</strong> {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
        </div>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" class="btn-primary">Шығу</button>
        </form>
    </div>
</body>
<style>
    body {
        height: 100%;
        margin: 0;
        font-family: 'Inter', sans-serif;
        background-color: #4a75a8;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .profile-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #e0ebf5;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-container h2 {
        color: #4a75a8;
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-details {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
    }

    .profile-details strong {
        color: #4a75a8;
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
        display: block;
        margin: 20px auto 0;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #3a5d8a;
    }
</style>
