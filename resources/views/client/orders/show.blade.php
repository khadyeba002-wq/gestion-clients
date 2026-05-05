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

body > *, .container, .container-fluid, #app, [class*="wrapper"] {
    max-width: none !important;
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
}

/* ═══════════════════
   PAGE
═══════════════════ */
.order-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: var(--cream);
}

/* ═══════════════════
   TOP BAR
═══════════════════ */
.order-topbar {
    background: var(--panel-bg);
    border-bottom: 1px solid var(--border);
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 44px;
    position: sticky;
    top: 0;
    z-index: 100;
}

.order-topbar::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
    background-size: 200% 100%;
    animation: shimmer 3s linear infinite;
}
@keyframes shimmer {
    from { background-position: 200% 0; }
    to   { background-position: -200% 0; }
}

.tb-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.tb-back {
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
.tb-back:hover { background: rgba(201,169,110,0.16); color: var(--gold); }

.tb-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}
.tb-circle {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1.5px solid var(--gold);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 14px;
    color: var(--gold);
    background: linear-gradient(135deg, #fff, var(--cream));
}
.tb-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px;
    font-weight: 300;
    color: var(--dark);
}
.tb-name em { color: var(--deep-rose); font-style: italic; }

.tb-order-id {
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    background: var(--gold-light);
    padding: 4px 12px;
    border-radius: 20px;
    opacity: .7;
}

/* ═══════════════════
   CONTENT
═══════════════════ */
.order-content {
    flex: 1;
    padding: 44px;
    max-width: 960px;
    margin: 0 auto;
    width: 100%;
}

/* ═══════════════════
   HERO BAND
═══════════════════ */
.order-hero {
    background: linear-gradient(135deg, var(--dark) 0%, #5A2830 100%);
    border-radius: 20px;
    padding: 36px 40px;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}
.order-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -60px;
    width: 240px; height: 240px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(232,160,176,0.15), transparent 70%);
    pointer-events: none;
}
.order-hero::after {
    content: '';
    position: absolute;
    bottom: -50px; left: 35%;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,169,110,0.10), transparent 70%);
    pointer-events: none;
}

.oh-left p.eyebrow {
    font-size: 9px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 8px;
}
.oh-left h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px;
    font-weight: 300;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 14px;
}
.oh-left h1 em { font-style: italic; color: var(--rose); }

/* Status badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 16px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 500;
    letter-spacing: 0.5px;
}
.status-badge .sb-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
}
.status-pending   { background: rgba(201,169,110,0.2);  color: var(--gold-light); }
.status-pending   .sb-dot { background: var(--gold-light); }
.status-confirmed { background: rgba(59,130,246,0.2);   color: #93C5FD; }
.status-confirmed .sb-dot { background: #93C5FD; }
.status-shipped   { background: rgba(139,92,246,0.2);   color: #C4B5FD; }
.status-shipped   .sb-dot { background: #C4B5FD; }
.status-delivered { background: rgba(107,175,146,0.2);  color: #6EE7B7; }
.status-delivered .sb-dot { background: #6EE7B7; }
.status-cancelled { background: rgba(239,68,68,0.2);    color: #FCA5A5; }
.status-cancelled .sb-dot { background: #FCA5A5; }

/* Total box */
.oh-total {
    text-align: center;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 20px 30px;
    flex-shrink: 0;
}
.oh-total p {
    font-size: 9px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 8px;
}
.oh-total .amount {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px;
    font-weight: 300;
    color: #fff;
    line-height: 1;
}
.oh-total .currency {
    font-size: 12px;
    color: var(--gold-light);
    letter-spacing: 2px;
    margin-top: 5px;
}

/* ═══════════════════
   PROGRESS TRACKER
═══════════════════ */
.progress-card {
    background: var(--panel-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 26px 32px;
    margin-bottom: 24px;
}
.progress-card h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 400;
    color: var(--dark);
    margin-bottom: 22px;
}
.progress-card h3 em { color: var(--deep-rose); font-style: italic; }

.tracker {
    display: flex;
    align-items: flex-start;
    gap: 0;
}
.track-step {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
}
.track-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 14px;
    left: calc(50% + 15px);
    right: calc(-50% + 15px);
    height: 2px;
    background: var(--border);
}
.track-step.done:not(:last-child)::after {
    background: linear-gradient(to right, var(--gold), var(--rose));
}
.track-dot {
    width: 28px; height: 28px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px;
    margin-bottom: 10px;
    position: relative; z-index: 1;
    border: 2px solid var(--border);
    background: var(--cream);
    color: var(--muted);
    transition: all .3s;
}
.track-step.done .track-dot {
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    border-color: transparent;
    color: #fff;
    box-shadow: 0 4px 12px rgba(196,116,138,0.3);
}
.track-step.current .track-dot {
    background: var(--panel-bg);
    border-color: var(--gold);
    color: var(--gold);
    box-shadow: 0 0 0 4px rgba(201,169,110,0.15);
}
.track-label {
    font-size: 10.5px;
    color: var(--muted);
    letter-spacing: 0.3px;
    line-height: 1.4;
    max-width: 80px;
}
.track-step.done .track-label { color: var(--dark); font-weight: 500; }
.track-step.current .track-label { color: var(--gold); font-weight: 500; }

/* ═══════════════════
   ITEMS TABLE CARD
═══════════════════ */
.items-card {
    background: var(--panel-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 24px;
}
.items-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 28px;
    border-bottom: 1px solid var(--border);
}
.items-card-head h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 400;
    color: var(--dark);
}
.items-card-head h3 em { color: var(--deep-rose); font-style: italic; }
.items-count {
    font-size: 11px;
    letter-spacing: 1px;
    color: var(--muted);
    background: var(--gold-light);
    padding: 3px 11px;
    border-radius: 20px;
    opacity: .7;
}

/* Table */
table { width: 100%; border-collapse: collapse; }
thead th {
    text-align: left;
    font-size: 9.5px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
    padding: 13px 28px;
    border-bottom: 1px solid var(--border);
    background: rgba(247,237,235,0.4);
}
tbody tr {
    border-bottom: 1px solid rgba(201,169,110,0.06);
    transition: background .18s;
}
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(247,237,235,0.6); }
tbody td {
    padding: 16px 28px;
    font-size: 13.5px;
    color: var(--text);
    vertical-align: middle;
}

/* Product cell */
.prod-cell {
    display: flex;
    align-items: center;
    gap: 14px;
}
.prod-thumb {
    width: 52px; height: 52px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    background: var(--cream);
    border: 1px solid var(--border);
}
.prod-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
}
.prod-thumb-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    font-family: 'Cormorant Garamond', serif;
    font-size: 13px;
    font-style: italic;
    color: #fff;
    font-weight: 600;
}
.prod-name {
    font-size: 14px;
    font-weight: 500;
    color: var(--dark);
    margin-bottom: 3px;
}
.prod-deleted {
    font-size: 11px;
    color: var(--muted);
    font-style: italic;
}

/* Price / qty cells */
.price-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px;
    font-weight: 400;
    color: var(--dark);
}
.price-val small {
    font-family: 'Raleway', sans-serif;
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 1px;
}
.qty-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px; height: 30px;
    border-radius: 8px;
    background: rgba(201,169,110,0.1);
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
}
.total-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 400;
    color: var(--deep-rose);
}
.total-val small {
    font-family: 'Raleway', sans-serif;
    font-size: 10px;
    color: var(--muted);
    letter-spacing: 1px;
}

/* ═══════════════════
   SUMMARY CARD
═══════════════════ */
.summary-card {
    background: var(--panel-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 26px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}
.summary-note {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.summary-note span { font-size: 18px; flex-shrink: 0; }
.summary-note p {
    font-size: 12px;
    color: var(--muted);
    line-height: 1.7;
    letter-spacing: 0.3px;
}
.summary-total {
    text-align: right;
    flex-shrink: 0;
}
.summary-total p {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 6px;
}
.summary-total .big {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px;
    font-weight: 300;
    color: var(--dark);
    line-height: 1;
}
.summary-total .big em {
    font-family: 'Raleway', sans-serif;
    font-size: 13px;
    font-style: normal;
    color: var(--gold);
    letter-spacing: 1.5px;
    margin-left: 6px;
}

/* ═══════════════════
   ANIMATIONS
═══════════════════ */
.fu { opacity:0; transform:translateY(16px); animation: fadeUp .45s ease forwards; }
.d1{animation-delay:.05s}.d2{animation-delay:.12s}
.d3{animation-delay:.19s}.d4{animation-delay:.27s}.d5{animation-delay:.35s}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ═══════════════════
   RESPONSIVE
═══════════════════ */
@media(max-width:700px) {
    .order-hero { flex-direction:column; align-items:flex-start; }
    .oh-total { width:100%; }
    .tracker { flex-direction:column; gap:14px; align-items:flex-start; }
    .track-step { flex-direction:row; text-align:left; gap:12px; }
    .track-step:not(:last-child)::after { display:none; }
    .track-label { max-width:none; }
    .summary-card { flex-direction:column; align-items:flex-start; }
    .summary-total { text-align:left; }
    .order-content { padding:24px 18px; }
    .order-topbar  { padding:0 18px; }
    thead th:nth-child(2), tbody td:nth-child(2) { display:none; }
}
</style>

<div class="order-page">

    {{-- ── TOP BAR ── --}}
    <header class="order-topbar fu d1">
        <div class="tb-left">
            <a href="{{ route('client.orders.index') }}" class="tb-back">← Retour</a>
            <div class="tb-brand">
                <div class="tb-circle">Lh</div>
                <span class="tb-name">Lady's <em>Home</em></span>
            </div>
        </div>
        <span class="tb-order-id">Commande #{{ $order->id }}</span>
    </header>

    {{-- ── CONTENT ── --}}
    <div class="order-content">

        {{-- Hero --}}
        <div class="order-hero fu d1">
            <div class="oh-left">
                <p class="eyebrow">Lady's Home · Suivi</p>
                <h1>Commande <em>#{{ $order->id }}</em></h1>

                @php
                    $statusMap = [
                        'pending'   => ['label' => '⏳ En attente',  'class' => 'status-pending'],
                        'confirmed' => ['label' => '✅ Confirmée',   'class' => 'status-confirmed'],
                        'shipped'   => ['label' => '🚚 Expédiée',   'class' => 'status-shipped'],
                        'delivered' => ['label' => '📦 Livrée',     'class' => 'status-delivered'],
                        'cancelled' => ['label' => '✖ Annulée',     'class' => 'status-cancelled'],
                    ];
                    $st = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'class' => 'status-pending'];
                @endphp

                <div class="status-badge {{ $st['class'] }}">
                    <div class="sb-dot"></div>
                    {{ $st['label'] }}
                </div>
            </div>

            <div class="oh-total">
                <p>Total commande</p>
                <div class="amount">{{ number_format($order->total, 0, ',', ' ') }}</div>
                <div class="currency">FCFA</div>
            </div>
        </div>

        {{-- Progress tracker --}}
        @if($order->status !== 'cancelled')
        @php
            $steps = ['pending','confirmed','shipped','delivered'];
            $currentIdx = array_search($order->status, $steps);
            if ($currentIdx === false) $currentIdx = 0;
        @endphp
        <div class="progress-card fu d2">
            <h3>Suivi de <em>livraison</em></h3>
            <div class="tracker">
                @foreach([
                    ['pending',   '📋', 'Commande passée'],
                    ['confirmed', '✅', 'Confirmée'],
                    ['shipped',   '🚚', 'En livraison'],
                    ['delivered', '📦', 'Livrée'],
                ] as $i => [$val, $ico, $lbl])
                <div class="track-step {{ $i < $currentIdx ? 'done' : ($i == $currentIdx ? 'current' : '') }}">
                    <div class="track-dot">{{ $i < $currentIdx ? '✓' : $ico }}</div>
                    <div class="track-label">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Items --}}
        <div class="items-card fu d3">
            <div class="items-card-head">
                <h3>Articles <em>commandés</em></h3>
                <span class="items-count">{{ $order->items->count() }} article(s)</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="prod-cell">
                                <div class="prod-thumb">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                             alt="{{ $item->product->name }}">
                                    @else
                                        <div class="prod-thumb-placeholder">Lh</div>
                                    @endif
                                </div>
                                <div>
                                    @if($item->product)
                                        <div class="prod-name">{{ $item->product->name }}</div>
                                    @else
                                        <div class="prod-name prod-deleted">Produit supprimé</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="price-val">
                                {{ number_format($item->price, 0, ',', ' ') }}
                                <small>FCFA</small>
                            </span>
                        </td>
                        <td>
                            <span class="qty-pill">{{ $item->quantity }}</span>
                        </td>
                        <td>
                            <span class="total-val">
                                {{ number_format($item->price * $item->quantity, 0, ',', ' ') }}
                                <small>FCFA</small>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Summary --}}
        <div class="summary-card fu d4">
            <div class="summary-note">
                <span>🔒</span>
                <p>
                    Votre commande a été enregistrée et sera traitée dans les plus brefs délais.<br>
                    Notre équipe vous contactera pour confirmer la livraison.
                </p>
            </div>
            <div class="summary-total">
                <p>Montant total</p>
                <div class="big">
                    {{ number_format($order->total, 0, ',', ' ') }}
                    <em>FCFA</em>
                </div>
            </div>
        </div>

    </div>{{-- /order-content --}}
</div>{{-- /order-page --}}

@endsection
