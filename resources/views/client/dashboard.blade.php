{{-- resources/views/client/dashboard.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
:root{
    --cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;
    --deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;
    --dark:#3A2028;--panel-bg:#FDF8F5;--border:rgba(201,169,110,0.15);
    --muted:rgba(58,32,40,0.42);--success:#6BAF92;
    --sidebar-w:258px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{width:100%;height:100%;font-family:'Raleway',sans-serif;background:var(--cream);}
body>*{max-width:none!important;padding:0!important;margin:0!important;}
.container,.container-fluid,#app,main{max-width:none!important;padding:0!important;margin:0!important;width:100%!important;}

/* ─── INTRO ─── */
#intro{position:fixed;inset:0;z-index:9999;overflow:hidden;background:var(--dark);}
#intro img{width:100%;height:100%;object-fit:cover;animation:introPan 5s ease-out forwards;}
#intro::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(58,32,40,.55) 0%,transparent 55%,rgba(201,169,110,.12) 100%);pointer-events:none;}
.intro-badge{position:absolute;bottom:52px;left:52px;z-index:2;opacity:0;animation:fadeUp 1s ease forwards 1s;}
.intro-badge::before{content:'';display:block;width:40px;height:1px;background:var(--gold);margin-bottom:14px;}
.intro-title{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:44px;font-weight:300;color:#fff;line-height:1;text-shadow:0 2px 24px rgba(58,32,40,.6);}
.intro-sub{font-size:9px;letter-spacing:5px;text-transform:uppercase;color:var(--gold-light);margin-top:8px;}
@keyframes introPan{0%{transform:scale(1.08);opacity:0}15%{opacity:1}100%{transform:scale(1);opacity:1}}

/* ─── LAYOUT ─── */
.lh-layout{display:flex;width:100vw;min-height:100vh;}

/* ─── SIDEBAR ─── */
.lh-sidebar{
    width:var(--sidebar-w);min-height:100vh;
    background:var(--panel-bg);border-right:1px solid var(--border);
    display:flex;flex-direction:column;padding:32px 20px 24px;
    position:sticky;top:0;height:100vh;overflow-y:auto;
    box-shadow:4px 0 24px rgba(58,32,40,.04);flex-shrink:0;z-index:50;
}
.lh-sidebar::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;
    background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));
    background-size:200% 100%;animation:shimmer 3s linear infinite;}
@keyframes shimmer{from{background-position:200% 0}to{background-position:-200% 0}}

/* Logo */
.sb-logo{display:flex;align-items:center;gap:11px;margin-bottom:28px;padding-top:6px;}
.logo-circle{width:42px;height:42px;border-radius:50%;border:1.5px solid var(--gold);display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#fff,var(--cream));box-shadow:0 4px 14px rgba(201,169,110,.18);font-family:'Cormorant Garamond',serif;font-style:italic;font-size:16px;color:var(--gold);flex-shrink:0;}
.logo-text .lt{font-family:'Cormorant Garamond',serif;font-size:17px;color:var(--dark);letter-spacing:.4px;display:block;line-height:1;}
.logo-text .lt em{font-style:italic;color:var(--deep-rose);}
.logo-text .ls{font-size:8px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:300;margin-top:3px;display:block;}

/* User badge */
.sb-user{display:flex;align-items:center;gap:9px;background:rgba(201,169,110,.07);border:1px solid var(--border);border-radius:10px;padding:9px 11px;margin-bottom:24px;}
.sb-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--blush),var(--rose));display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-size:15px;color:#fff;font-style:italic;flex-shrink:0;}
.sb-user-info p{font-size:12px;font-weight:500;color:var(--dark);line-height:1;margin-bottom:3px;}
.sb-user-info small{font-size:8.5px;letter-spacing:1.5px;text-transform:uppercase;color:var(--gold);}
.sb-online{margin-left:auto;width:7px;height:7px;border-radius:50%;background:var(--success);box-shadow:0 0 5px rgba(107,175,146,.55);flex-shrink:0;}

/* Section label */
.sb-section{font-size:8px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:600;margin:18px 0 7px 4px;}

/* Nav */
.lh-sidebar nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;font-size:12px;font-weight:400;letter-spacing:.4px;color:var(--muted);text-decoration:none;transition:background .18s,color .18s,border-color .18s;margin-bottom:2px;border-left:2px solid transparent;border-radius:0 6px 6px 0;}
.lh-sidebar nav a:hover,.lh-sidebar nav a.active{background:rgba(201,169,110,.09);color:var(--dark);border-left-color:var(--gold);}
.nav-icon{font-size:15px;flex-shrink:0;}
.cart-badge{margin-left:auto;background:var(--deep-rose);color:#fff;font-size:9px;padding:2px 7px;border-radius:20px;}

/* Sidebar footer */
.sb-footer{margin-top:auto;padding-top:18px;border-top:1px solid var(--border);}
.sb-user-name{font-size:10px;color:var(--muted);letter-spacing:.3px;margin-bottom:10px;line-height:1.5;}
.sb-user-name strong{color:var(--dark);}
.btn-logout{display:flex;align-items:center;gap:9px;width:100%;padding:9px 12px;border:1px solid rgba(196,116,138,.22);border-radius:8px;background:rgba(196,116,138,.05);color:rgba(196,116,138,.75);font-family:'Raleway',sans-serif;font-size:11.5px;font-weight:500;cursor:pointer;transition:all .2s;text-align:left;}
.btn-logout:hover{background:rgba(196,116,138,.12);color:var(--deep-rose);border-color:var(--deep-rose);transform:translateX(2px);}

/* ─── MAIN ─── */
.lh-main{flex:1;min-width:0;min-height:100vh;display:flex;flex-direction:column;background:var(--cream);overflow-y:auto;}

/* Topbar */
.lh-topbar{display:flex;align-items:center;justify-content:space-between;padding:16px 42px;background:var(--panel-bg);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:40;}
.topbar-title{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:300;color:var(--dark);letter-spacing:1px;}
.topbar-title em{font-style:italic;color:var(--deep-rose);}
.topbar-right{display:flex;align-items:center;gap:16px;}
.topbar-date{font-size:11px;letter-spacing:.5px;color:var(--muted);}
.topbar-cart-btn{display:flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;text-decoration:none;font-size:11px;font-weight:500;padding:7px 15px;border-radius:8px;transition:opacity .2s,transform .2s;box-shadow:0 4px 12px rgba(196,116,138,.25);}
.topbar-cart-btn:hover{opacity:.9;transform:translateY(-1px);}
.topbar-cart-count{background:#fff;color:var(--deep-rose);font-size:9px;font-weight:700;padding:1px 6px;border-radius:20px;}

/* Content */
.lh-content{flex:1;padding:38px 42px;}

/* Welcome */
.welcome-row{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:8px;}
.welcome-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.welcome-title{font-family:'Cormorant Garamond',serif;font-size:34px;font-weight:300;color:var(--dark);line-height:1.1;}
.welcome-title em{font-style:italic;color:var(--deep-rose);}
.welcome-date{text-align:right;font-size:11px;color:var(--muted);letter-spacing:.5px;line-height:1.6;}

/* Gold divider */
.gold-divider{display:flex;align-items:center;gap:10px;margin:20px 0 32px;}
.gold-divider span{flex:1;height:1px;}
.gold-divider span:first-child{background:linear-gradient(to right,transparent,var(--gold));}
.gold-divider span:last-child{background:linear-gradient(to left,transparent,var(--gold));}
.gold-divider i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}

/* ─── STAT CARDS ─── */
.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:44px;}
.stat-card{background:var(--panel-bg);border:1px solid var(--border);padding:24px 26px;position:relative;overflow:hidden;box-shadow:0 8px 28px rgba(58,32,40,.05);transition:transform .2s,box-shadow .2s;}
.stat-card:hover{transform:translateY(-4px);box-shadow:0 18px 40px rgba(58,32,40,.09);}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));}
.stat-icon{font-size:20px;margin-bottom:12px;display:block;}
.stat-label{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:7px;}
.stat-value{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);line-height:1;}
.stat-value small{font-family:'Raleway',sans-serif;font-size:10px;color:var(--gold);letter-spacing:1px;margin-left:4px;}

/* ─── ALERT SESSION ─── */
.session-alert{padding:12px 18px;margin-bottom:22px;font-size:12px;display:flex;align-items:center;gap:10px;border-radius:0;border-left:3px solid var(--gold);background:rgba(201,169,110,.09);color:var(--dark);}

/* ─── PRODUCT SECTION ─── */
.section-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.section-title{font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:300;color:var(--dark);margin-bottom:24px;}
.section-title em{font-style:italic;color:var(--deep-rose);}

/* Filter tabs */
.filter-tabs{display:flex;gap:6px;margin-bottom:24px;flex-wrap:wrap;}
.filter-tab{padding:6px 16px;font-size:9.5px;letter-spacing:2px;text-transform:uppercase;font-family:'Raleway',sans-serif;cursor:pointer;border:1px solid var(--border);color:var(--muted);transition:all .2s;background:transparent;text-decoration:none;}
.filter-tab:hover,.filter-tab.active{border-color:var(--gold);color:var(--gold);background:rgba(201,169,110,.07);}

/* Product grid */
.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(205px,1fr));gap:20px;}
.product-card{background:var(--panel-bg);border:1px solid rgba(201,169,110,.14);box-shadow:0 6px 20px rgba(58,32,40,.05);overflow:hidden;transition:transform .25s,box-shadow .25s;position:relative;}
.product-card:hover{transform:translateY(-5px);box-shadow:0 20px 44px rgba(58,32,40,.1);}
.product-img-wrap{position:relative;overflow:hidden;height:170px;background:var(--cream);}
.product-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;}
.product-card:hover .product-img-wrap img{transform:scale(1.06);}
.product-img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:36px;background:rgba(201,169,110,.07);}
/* Shimmer top on card */
.product-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));z-index:1;}
.product-body{padding:14px 16px 16px;}
.product-cat{font-size:8.5px;letter-spacing:2.5px;text-transform:uppercase;color:var(--gold);margin-bottom:4px;}
.product-name{font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:400;color:var(--dark);margin-bottom:5px;line-height:1.2;}
.product-price{font-size:13px;color:var(--deep-rose);font-weight:500;letter-spacing:.4px;margin-bottom:13px;}
.product-price span{font-size:9.5px;color:var(--gold);font-weight:400;letter-spacing:1.5px;margin-left:3px;}
/* Stock indicator */
.stock-indicator{display:flex;align-items:center;gap:5px;font-size:9px;letter-spacing:1px;color:var(--muted);margin-bottom:12px;}
.stock-dot{width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.stock-dot.ok{background:var(--success);}
.stock-dot.low{background:#E0A854;}
.stock-dot.out{background:var(--deep-rose);}
/* Add to cart button */
.btn-cart{width:100%;padding:10px;background:linear-gradient(135deg,var(--deep-rose) 0%,var(--gold) 100%);border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:9px;font-weight:500;letter-spacing:3px;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;box-shadow:0 4px 14px rgba(196,116,138,.22);}
.btn-cart::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);transition:left .5s;}
.btn-cart:hover::before{left:160%;}.btn-cart:hover{transform:translateY(-1px);box-shadow:0 8px 22px rgba(196,116,138,.32);}
.btn-cart:disabled{opacity:.5;cursor:not-allowed;transform:none;}
/* Empty state */
.empty-products{grid-column:1/-1;text-align:center;padding:60px 20px;}
.empty-products p{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:var(--muted);}

/* ─── ANIMATIONS ─── */
@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
.fu{opacity:0;transform:translateY(16px);animation:fadeUp .45s ease forwards;}
.d1{animation-delay:.06s}.d2{animation-delay:.12s}.d3{animation-delay:.19s}
.d4{animation-delay:.26s}.d5{animation-delay:.33s}.d6{animation-delay:.40s}

/* ─── RESPONSIVE ─── */
@media(max-width:1024px){.stats{grid-template-columns:1fr 1fr;}.lh-content{padding:28px 26px;}.lh-topbar{padding:14px 26px;}}
@media(max-width:768px){.lh-sidebar{display:none;}.stats{grid-template-columns:1fr;}.welcome-row{flex-direction:column;align-items:flex-start;gap:8px;}.lh-content{padding:22px 16px;}.lh-topbar{padding:12px 16px;}}
::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

{{-- ─── INTRO ─── --}}
<div id="intro">
    <img src="{{ asset('image/client.png') }}" alt="Lady's Home">
    <div class="intro-badge">
        <p class="intro-title">Lady's Home</p>
        <p class="intro-sub">Cosmétiques · Beauté · Confiance</p>
    </div>
</div>

{{-- ─── LAYOUT ─── --}}
<div class="lh-layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="lh-sidebar">

        <div class="sb-logo">
            <div class="logo-circle">Lh</div>
            <div class="logo-text">
                <span class="lt">Lady's <em>Home</em></span>
                <span class="ls">Espace Client</span>
            </div>
        </div>

        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="sb-user-info">
                <p>{{ auth()->user()->name }}</p>
                <small>Cliente</small>
            </div>
            <div class="sb-online"></div>
        </div>

        <p class="sb-section">Navigation</p>
        <nav>
            <a href="{{ route('client.dashboard') }}" class="active">
                <span class="nav-icon">🏠</span> Accueil
            </a>
            <a href="{{ route('products.index') }}">
                <span class="nav-icon">🧴</span> Produits
            </a>
            <a href="{{ route('cart.index') }}">
                <span class="nav-icon">🛒</span> Mon panier
                @if(($cartCount ?? 0) > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('client.orders.index') }}">
                <span class="nav-icon">📦</span> Mes commandes
            </a>
            <a href="{{ route('profile.edit') }}">
                <span class="nav-icon">👤</span> Mon profil
            </a>
        </nav>


        <div style="margin-top:20px">
            <a href="{{ route('checkout') }}"
               style="display:flex;align-items:center;justify-content:center;gap:8px;padding:11px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;text-decoration:none;font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:2.5px;text-transform:uppercase;border-radius:0;box-shadow:0 4px 14px rgba(196,116,138,.25);transition:transform .2s;">
                💳 Payer maintenant
            </a>
        </div>

        <div class="sb-footer">
            <p class="sb-user-name">Connectée en tant que<br><strong>{{ auth()->user()->name }}</strong></p>
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout">
                    <span style="font-size:15px">↩</span> Déconnexion
                </button>
            </form>
        </div>

    </aside>

    {{-- ── MAIN ── --}}
    <div class="lh-main">

        {{-- Topbar --}}
        <header class="lh-topbar fu d1">
            <div class="topbar-title">Tableau de <em>Bord</em></div>
            <div class="topbar-right">
                <span class="topbar-date" id="live-date"></span>
                @if(($cartCount ?? 0) > 0)
                    <a href="{{ route('cart.index') }}" class="topbar-cart-btn">
                        🛒 Panier <span class="topbar-cart-count">{{ $cartCount }}</span>
                    </a>
                @endif
            </div>
        </header>

        <div class="lh-content">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="session-alert"><span>✦</span> {{ session('success') }}</div>
            @endif

            {{-- Welcome --}}
            <div class="welcome-row fu d2">
                <div>
                    <p class="welcome-eyebrow">Tableau de bord</p>
                    <h1 class="welcome-title">Bonjour, <em>{{ auth()->user()->name }}</em> 👋</h1>
                </div>
                <div class="welcome-date" id="live-date-2"></div>
            </div>

            <div class="gold-divider fu d3"><span></span><i></i><i></i><i></i><span></span></div>

            {{-- Stats --}}
            <div class="stats">
                <div class="stat-card fu d3">
                    <span class="stat-icon">📦</span>
                    <p class="stat-label">Mes commandes</p>
                    <div class="stat-value">{{ $ordersCount ?? 0 }}</div>
                </div>
                <div class="stat-card fu d4">
                    <span class="stat-icon">💰</span>
                    <p class="stat-label">Total dépensé</p>
                    <div class="stat-value">{{ number_format($totalSpent ?? 0, 0, ',', ' ') }}<small>FCFA</small></div>
                </div>
                <div class="stat-card fu d5">
                    <span class="stat-icon">🛒</span>
                    <p class="stat-label">Articles panier</p>
                    <div class="stat-value">{{ $cartCount ?? 0 }}</div>
                </div>
            </div>

            {{-- Products --}}
            <p class="section-eyebrow fu d5">Catalogue</p>
            <h2 class="section-title fu d6">Produits <em>disponibles</em></h2>

            {{-- Filter tabs --}}
            <div class="filter-tabs fu d6">
                <a href="{{ route('client.dashboard') }}" class="filter-tab active">Tous</a>
                @foreach($categories ?? [] as $cat)
                    <a href="{{ route('client.dashboard', ['category' => $cat->id]) }}"
                       class="filter-tab {{ request('category') == $cat->id ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                <div class="product-card">
                    <div class="product-img-wrap">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="product-img-placeholder">🧴</div>
                        @endif
                    </div>
                    <div class="product-body">
                        @if($product->category)
                            <div class="product-cat">{{ $product->category->name }}</div>
                        @endif
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">
                            {{ number_format($product->price, 0, ',', ' ') }}<span>FCFA</span>
                        </div>

                        {{-- Stock indicator --}}
                        <div class="stock-indicator">
                            @if($product->stock <= 0)
                                <span class="stock-dot out"></span> Rupture de stock
                            @elseif($product->stock <= 5)
                                <span class="stock-dot low"></span> Plus que {{ $product->stock }} en stock
                            @else
                                <span class="stock-dot ok"></span> En stock
                            @endif
                        </div>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                🛒 Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-products">
                    <p>Aucun produit disponible pour le moment</p>
                </div>
                @endforelse
            </div>

        </div>{{-- /lh-content --}}
    </div>{{-- /lh-main --}}

</div>{{-- /lh-layout --}}

<script>
setTimeout(() => {
    const intro = document.getElementById('intro');
    intro.style.transition = 'opacity 1.5s ease';
    intro.style.opacity = '0';
    setTimeout(() => intro.style.display = 'none', 1500);
}, 4500);

(function() {
    const opts = {weekday:'long',day:'numeric',month:'long',year:'numeric'};
    const txt = new Date().toLocaleDateString('fr-FR', opts).replace(/^\w/, c => c.toUpperCase());
    ['live-date','live-date-2'].forEach(id => {
        const el = document.getElementById(id);
        if(el) el.innerHTML = txt;
    });
})();

document.querySelectorAll('.lh-sidebar nav a').forEach(link => {
    link.addEventListener('click', () => {
        document.querySelectorAll('.lh-sidebar nav a').forEach(l => l.classList.remove('active'));
        link.classList.add('active');
    });
});
</script>
@endsection
