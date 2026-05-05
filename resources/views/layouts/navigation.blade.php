<nav class="navbar">
    <div class="nav-container">

```
    <!-- LOGO -->
    <div class="logo">
        <a href="/">Lady's <span>Home</span></a>
    </div>

    <!-- MENU -->
    <ul class="nav-links">
        <li><a href="/">Accueil</a></li>
        <li><a href="#">Produits</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

    <!-- DROITE -->
    <div class="nav-right">
        @auth
            <span class="user">{{ Auth::user()->name }}</span>

            <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        @endauth
    </div>

</div>
```

</nav>

<style>
.navbar {
    background: #fff;
    border-bottom: 1px solid #eee;
    padding: 15px 40px;
    font-family: 'Raleway', sans-serif;
}

.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo a {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px;
    color: #C4748A;
    text-decoration: none;
}

.logo span {
    color: #C9A96E;
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 25px;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

.nav-links a:hover {
    color: #C4748A;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user {
    font-size: 13px;
    color: #555;
}

.btn {
    background: #C4748A;
    color: #fff;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
}

.btn-register {
    background: #C9A96E;
    color: #fff;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
}

.logout {
    background: none;
    border: none;
    color: red;
    cursor: pointer;
}
</style>
