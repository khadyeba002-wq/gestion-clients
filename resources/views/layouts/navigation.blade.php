<nav class="lh-nav">
    <div class="lh-nav__brand">
        <a href="{{ route('welcome') }}">Lady's <span>Home</span></a>
    </div>

    <div class="lh-nav__links">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.products.index') }}">Produits</a>
                <a href="{{ route('admin.orders.index') }}">Commandes</a>
                <a href="{{ route('admin.clients.index') }}">Clients</a>
                <a href="{{ route('admin.payments.index') }}">Paiements</a>
                <a href="{{ route('admin.stats') }}">Stats</a>
                <a href="{{ route('admin.settings.index') }}">Parametres</a>
            @else
                <a href="{{ route('client.dashboard') }}">Accueil</a>
                <a href="{{ route('products.index') }}">Produits</a>
                <a href="{{ route('cart.index') }}">Panier</a>
                <a href="{{ route('client.orders.index') }}">Commandes</a>
                <a href="{{ route('profile.edit') }}">Profil</a>
            @endif
        @else
            <a href="{{ route('welcome') }}">Accueil</a>
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endauth
    </div>

    <div class="lh-nav__right">
        @auth
            <span>{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Deconnexion</button>
            </form>
        @else
            <a class="lh-nav__cta" href="{{ route('login') }}">Entrer</a>
        @endauth
    </div>
</nav>

<style>
    .lh-nav {
        position: sticky;
        top: 0;
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        padding: 14px 34px;
        border-bottom: 1px solid rgba(201, 169, 110, .18);
        background: rgba(255, 250, 248, .94);
        backdrop-filter: blur(14px);
        font-family: 'Raleway', sans-serif;
        box-shadow: 0 8px 28px rgba(58, 32, 40, .05);
    }

    .lh-nav__brand a {
        color: #3A2028;
        font-family: 'Cormorant Garamond', serif;
        font-size: 24px;
        text-decoration: none;
        white-space: nowrap;
    }

    .lh-nav__brand span { color: #C4748A; font-style: italic; }

    .lh-nav__links {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .lh-nav__links a {
        border: 1px solid rgba(201, 169, 110, .2);
        border-radius: 999px;
        color: #4A2E34;
        font-size: 11px;
        letter-spacing: 1.4px;
        padding: 7px 13px;
        text-decoration: none;
        text-transform: uppercase;
        transition: all .2s ease;
    }

    .lh-nav__links a:hover {
        border-color: #C9A96E;
        background: rgba(201, 169, 110, .1);
        color: #C4748A;
        transform: translateY(-1px);
    }

    .lh-nav__right {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #9C7A80;
        font-size: 12px;
        white-space: nowrap;
    }

    .lh-nav__right form { margin: 0; }

    .lh-nav__right button,
    .lh-nav__cta {
        border: 0;
        border-radius: 999px;
        background: linear-gradient(135deg, #C4748A, #C9A96E);
        color: #fff;
        cursor: pointer;
        font-family: 'Raleway', sans-serif;
        font-size: 11px;
        letter-spacing: 1.5px;
        padding: 8px 14px;
        text-decoration: none;
        text-transform: uppercase;
    }

    @media (max-width: 900px) {
        .lh-nav { align-items: flex-start; flex-direction: column; padding: 14px 18px; }
        .lh-nav__links { justify-content: flex-start; }
    }
</style>
