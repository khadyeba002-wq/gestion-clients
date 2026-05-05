@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --cream:      #FDF5F0;
    --blush:      #F2C4CE;
    --rose:       #E8A0B0;
    --deep-rose:  #C4748A;
    --gold:       #C9A96E;
    --gold-light: #E8D5B0;
    --dark:       #3A2028;
    --panel-bg:   #FDF8F5;
    --border:     rgba(201,169,110,0.15);
    --muted:      rgba(58,32,40,0.42);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    font-family: 'Raleway', sans-serif;
    background: var(--cream);
}

/* Neutralise padding du layout parent */
body > *, .container, .container-fluid, #app, [class*="wrapper"] {
    max-width: none !important;
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
}

/* ═══════════════════════
   PAGE WRAPPER
═══════════════════════ */
.products-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: var(--cream);
}

/* ═══════════════════════
   TOP BAR
═══════════════════════ */
.products-topbar {
    background: var(--panel-bg);
    border-bottom: 1px solid var(--border);
    padding: 0 44px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 100;
}

/* Shimmer bar */
.products-topbar::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
    background-size: 200% 100%;
    animation: shimmerBar 3s linear infinite;
}
@keyframes shimmerBar {
    from { background-position: 200% 0; }
    to   { background-position: -200% 0; }
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    border-radius: 8px;
    background: rgba(201,169,110,0.08);
    border: 1px solid var(--border);
    color: var(--dark);
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all .2s;
}
.back-btn:hover {
    background: rgba(201,169,110,0.16);
    color: var(--gold);
}
.back-btn span { font-size: 14px; }

.topbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}
.topbar-circle {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1.5px solid var(--gold);
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #fff, var(--cream));
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 14px;
    color: var(--gold);
}
.topbar-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px;
    font-weight: 300;
    color: var(--dark);
    letter-spacing: 0.5px;
}
.topbar-name em { color: var(--deep-rose); font-style: italic; }

.topbar-right {
    display: flex;
    align-items: center;
    gap: 14px;
}

.cart-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 18px;
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 500;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(196,116,138,0.25);
    transition: opacity .2s, transform .2s;
}
.cart-link:hover { opacity: .88; transform: translateY(-1px); }

.cart-badge-count {
    background: #fff;
    color: var(--deep-rose);
    font-size: 9px;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 20px;
}

/* ═══════════════════════
   HERO BAND
═══════════════════════ */
.products-hero {
    background: linear-gradient(135deg, var(--dark) 0%, #5A2830 100%);
    padding: 44px 44px 40px;
    position: relative;
    overflow: hidden;
}
.products-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(232,160,176,0.18), transparent 70%);
    pointer-events: none;
}
.products-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: 30%;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,169,110,0.10), transparent 70%);
    pointer-events: none;
}

.hero-eyebrow {
    font-size: 9px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 10px;
    font-weight: 400;
}
.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 38px;
    font-weight: 300;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 12px;
}
.hero-title em { font-style: italic; color: var(--rose); }
.hero-sub {
    font-size: 12px;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.38);
}
.hero-divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 22px;
    width: 200px;
}
.hero-divider span { flex: 1; height: 1px; background: linear-gradient(to right, var(--gold), transparent); }
.hero-divider i { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); display: inline-block; }

.hero-count {
    position: absolute;
    right: 44px;
    bottom: 36px;
    font-family: 'Cormorant Garamond', serif;
    font-size: 64px;
    font-weight: 300;
    color: rgba(255,255,255,0.05);
    letter-spacing: -2px;
    pointer-events: none;
    line-height: 1;
}

/* ═══════════════════════
   FILTER BAR
═══════════════════════ */
.filter-bar {
    background: var(--panel-bg);
    border-bottom: 1px solid var(--border);
    padding: 14px 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.filter-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-label {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
}

.filter-pill {
    padding: 5px 14px;
    border-radius: 20px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Raleway', sans-serif;
    font-size: 11px;
    cursor: pointer;
    transition: all .18s;
}
.filter-pill:hover,
.filter-pill.active {
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    color: #fff;
    border-color: transparent;
}

.product-count-badge {
    font-size: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--muted);
}
.product-count-badge strong {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 400;
    color: var(--dark);
    margin-right: 4px;
}

/* ═══════════════════════
   CONTENT
═══════════════════════ */
.products-content {
    flex: 1;
    padding: 40px 44px 60px;
}

/* ═══════════════════════
   PRODUCT GRID
═══════════════════════ */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 24px;
}

/* ═══════════════════════
   PRODUCT CARD
═══════════════════════ */
.product-card {
    background: var(--panel-bg);
    border: 1px solid rgba(201,169,110,0.14);
    box-shadow: 0 8px 26px rgba(58,32,40,0.05);
    overflow: hidden;
    transition: transform .28s, box-shadow .28s;
    position: relative;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 48px rgba(58,32,40,0.11);
}

/* Accent top border on hover */
.product-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, var(--rose), var(--gold));
    opacity: 0;
    transition: opacity .28s;
}
.product-card:hover::before { opacity: 1; }

/* Image */
.product-img-wrap {
    position: relative;
    overflow: hidden;
    height: 190px;
    background: var(--cream);
}
.product-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .55s ease;
}
.product-card:hover .product-img-wrap img { transform: scale(1.07); }

.product-img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 42px;
    background: rgba(201,169,110,0.07);
}

/* Body */
.product-body {
    padding: 18px 20px 20px;
}

.product-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 400;
    color: var(--dark);
    margin-bottom: 6px;
    line-height: 1.2;
}

.product-price {
    display: flex;
    align-items: baseline;
    gap: 5px;
    margin-bottom: 16px;
}
.product-price strong {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    font-weight: 400;
    color: var(--deep-rose);
    line-height: 1;
}
.product-price span {
    font-size: 10px;
    letter-spacing: 1.5px;
    color: var(--gold);
    font-weight: 500;
}

/* Separator */
.product-sep {
    height: 1px;
    background: linear-gradient(to right, var(--border), transparent);
    margin-bottom: 16px;
}

/* Add to cart button */
.btn-cart {
    width: 100%;
    padding: 11px;
    background: linear-gradient(135deg, var(--deep-rose) 0%, var(--gold) 100%);
    border: none;
    color: #fff;
    font-family: 'Raleway', sans-serif;
    font-size: 9.5px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(196,116,138,0.22);
}
.btn-cart::before {
    content: '';
    position: absolute; top: 0; left: -100%;
    width: 60%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), transparent);
    transition: left .5s;
}
.btn-cart:hover::before { left: 160%; }
.btn-cart:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 22px rgba(196,116,138,0.34);
}

/* ═══════════════════════
   EMPTY STATE
═══════════════════════ */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
}
.empty-state .empty-icon { font-size: 52px; margin-bottom: 16px; opacity: .45; }
.empty-state p {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    font-weight: 300;
    color: var(--muted);
    letter-spacing: 1px;
}
.empty-state small {
    display: block;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    margin-top: 8px;
    opacity: .6;
}

/* ═══════════════════════
   ANIMATIONS
═══════════════════════ */
.fu { opacity:0; transform:translateY(16px); animation: fadeUp .45s ease forwards; }
.d1{animation-delay:.04s}.d2{animation-delay:.10s}.d3{animation-delay:.17s}
.d4{animation-delay:.24s}.d5{animation-delay:.31s}.d6{animation-delay:.38s}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}

/* Card stagger */
.product-card { opacity:0; transform:translateY(20px); animation: fadeUp .4s ease forwards; }
@for($i = 1; $i <= 20; $i++)
    .product-card:nth-child({{ $i }}) { animation-delay: {{ 0.05 * $i }}s; }
@endfor

/* ═══════════════════════
   RESPONSIVE
═══════════════════════ */
@media (max-width: 768px) {
    .products-topbar, .products-hero,
    .filter-bar, .products-content { padding-left: 18px; padding-right: 18px; }
    .hero-title { font-size: 28px; }
    .products-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
    .hero-count { display: none; }
}
@media (max-width: 480px) {
    .products-grid { grid-template-columns: 1fr; }
    .filter-left { flex-wrap: wrap; }
}
</style>

<div class="products-page">

    {{-- ══ TOP BAR ══ --}}
    <header class="products-topbar fu d1">
        <div class="topbar-left">
            <a href="{{ route('client.dashboard') }}" class="back-btn">
                <span>←</span> Retour
            </a>
            <div class="topbar-brand">
                <div class="topbar-circle">Lh</div>
                <span class="topbar-name">Lady's <em>Home</em></span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('cart.index') }}" class="cart-link">
                🛒 Panier
                @if(($cartCount ?? 0) > 0)
                    <span class="cart-badge-count">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </header>

    {{-- ══ HERO ══ --}}
    <div class="products-hero fu d2">
        <p class="hero-eyebrow">Lady's Home · Catalogue</p>
        <h1 class="hero-title">Nos <em>Produits</em></h1>
        <p class="hero-sub">Cosmétiques · Beauté · Confiance</p>
        <div class="hero-divider">
            <span></span><i></i><i></i><i></i>
        </div>
        <div class="hero-count">{{ $products->count() }}</div>
    </div>

    {{-- ══ FILTER BAR ══ --}}
    <div class="filter-bar fu d3">
        <div class="filter-left">
            <span class="filter-label">Filtrer</span>
            <button class="filter-pill active" onclick="filterAll(this)">Tous</button>
        </div>
        <span class="product-count-badge">
            <strong>{{ $products->count() }}</strong> produit(s) disponible(s)
        </span>
    </div>

    {{-- ══ CONTENT ══ --}}
    <div class="products-content">
        <div class="products-grid">

            @forelse($products as $product)
            <div class="product-card">

                <div class="product-img-wrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="product-img-placeholder">🧴</div>
                    @endif
                </div>

                <div class="product-body">
                    <div class="product-name">{{ $product->name }}</div>

                    <div class="product-price">
                        <strong>{{ number_format($product->price, 0, ',', ' ') }}</strong>
                        <span>FCFA</span>
                    </div>

                    <div class="product-sep"></div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-cart">
                            🛒 &nbsp; Ajouter au panier
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">🧴</div>
                <p>Aucun produit disponible</p>
                <small>Revenez bientôt pour découvrir nos nouveautés</small>
            </div>
            @endforelse

        </div>
    </div>

</div>{{-- /products-page --}}

<script>
function filterAll(btn) {
    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
}
</script>

@endsection
