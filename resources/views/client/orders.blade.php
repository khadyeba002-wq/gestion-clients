@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --cream:      #FDF5F0;
    --blush:      #F2C4CE;
    --rose:       #E8A0B0;
    --deep-rose:  #C4748A;
    --gold:       #C9A96E;
    --gold-dim:   rgba(201,169,110,0.10);
    --gold-light: #E8D5B0;
    --dark:       #3A2028;
    --panel-bg:   #FDF8F5;
    --border:     rgba(201,169,110,0.16);
    --border-s:   rgba(201,169,110,0.09);
    --muted:      rgba(58,32,40,0.42);
    --text:       #3D2B1F;
    --white:      #FFFFFF;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    font-family: 'Raleway', sans-serif;
    background: var(--cream);
    color: var(--text);
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
.orders-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: var(--cream);
    position: relative;
}

/* Subtle grain */
.orders-page::before {
    content: '';
    position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    opacity: 0.018;
    pointer-events: none;
    z-index: 0;
}

/* ═══════════════════
   TOP BAR
═══════════════════ */
.orders-topbar {
    position: relative; z-index: 10;
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
.orders-topbar::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
    background-size: 200% 100%;
    animation: shimmerBar 3s linear infinite;
}
@keyframes shimmerBar {
    from { background-position: 200% 0; }
    to   { background-position: -200% 0; }
}

.tb-left { display: flex; align-items: center; gap: 16px; }

.tb-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--white);
    color: var(--muted);
    font-size: 11px;
    letter-spacing: 0.5px;
    text-decoration: none;
    transition: all .2s;
}
.tb-back:hover { border-color: var(--gold); color: var(--gold); background: var(--gold-dim); }
.tb-back svg { width:13px; height:13px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; transition:transform .2s; }
.tb-back:hover svg { transform: translateX(-2px); }

.tb-brand { display: flex; align-items: center; gap: 10px; }
.tb-circle {
    width: 36px; height: 36px; border-radius: 50%;
    border: 1.5px solid var(--gold);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-style: italic; font-size: 14px; color: var(--gold);
    background: linear-gradient(135deg, #fff, var(--cream));
}
.tb-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px; font-weight: 300; color: var(--dark);
}
.tb-name em { color: var(--deep-rose); font-style: italic; }

.tb-right { display: flex; align-items: center; gap: 12px; }
.tb-count {
    font-size: 11px; letter-spacing: 1px;
    color: var(--muted); background: var(--gold-light);
    padding: 4px 12px; border-radius: 20px; opacity: .75;
}

/* ═══════════════════
   HERO
═══════════════════ */
.orders-hero {
    position: relative; z-index: 1;
    background: linear-gradient(135deg, var(--dark) 0%, #5A2830 100%);
    padding: 40px 44px 36px;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
}
.orders-hero::before {
    content: ''; position: absolute;
    top: -80px; right: -60px;
    width: 240px; height: 240px; border-radius: 50%;
    background: radial-gradient(circle, rgba(232,160,176,0.15), transparent 70%);
    pointer-events: none;
}
.orders-hero::after {
    content: ''; position: absolute;
    bottom: -50px; left: 40%;
    width: 180px; height: 180px; border-radius: 50%;
    background: radial-gradient(circle, rgba(201,169,110,0.10), transparent 70%);
    pointer-events: none;
}
.hero-left { position: relative; z-index: 1; }
.hero-eyebrow {
    font-size: 9px; letter-spacing: 5px;
    text-transform: uppercase; color: var(--gold-light); margin-bottom: 8px;
}
.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px; font-weight: 300; color: #fff; line-height: 1; margin-bottom: 8px;
}
.hero-title em { font-style: italic; color: var(--rose); }
.hero-sub { font-size: 12px; letter-spacing: 0.5px; color: rgba(255,255,255,0.32); }

/* Hero summary pills */
.hero-pills { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1; }
.hero-pill {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px; padding: 12px 18px;
    text-align: center; min-width: 80px;
}
.hero-pill p { font-size: 9px; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 6px; }
.hero-pill span { font-family: 'Cormorant Garamond', serif; font-size: 26px; font-weight: 300; color: #fff; line-height: 1; }

/* ═══════════════════
   CONTENT
═══════════════════ */
.orders-content {
    position: relative; z-index: 1;
    flex: 1;
    padding: 36px 44px 60px;
}

/* Gold divider */
.gold-divider { display: flex; align-items: center; gap: 8px; margin-bottom: 28px; }
.gold-divider span { flex:1; height:1px; }
.gold-divider span:first-child { background: linear-gradient(to right, transparent, var(--border)); }
.gold-divider span:last-child  { background: linear-gradient(to left, transparent, var(--border)); }
.gold-divider i { display:block; width:4px; height:4px; border-radius:50%; background:var(--gold); opacity:.55; }

/* ═══════════════════
   CARD
═══════════════════ */
.orders-card {
    background: var(--panel-bg);
    border: 1px solid var(--border-s);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 32px rgba(58,32,40,0.07);
}
.card-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 28px;
    border-bottom: 1px solid var(--border-s);
    background: rgba(247,237,235,0.3);
}
.card-head h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 400; color: var(--dark);
}
.card-head h2 em { color: var(--deep-rose); font-style: italic; }
.card-head-right { display: flex; align-items: center; gap: 10px; }

/* ═══════════════════
   TABLE
═══════════════════ */
table { width: 100%; border-collapse: collapse; }
thead th {
    text-align: left;
    font-size: 9.5px; letter-spacing: 2px; text-transform: uppercase;
    color: var(--muted); font-weight: 400;
    padding: 14px 24px;
    border-bottom: 1px solid var(--border-s);
    white-space: nowrap;
}
tbody tr {
    border-bottom: 1px solid rgba(201,169,110,0.06);
    transition: background .18s;
}
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(247,237,235,0.65); }
tbody td { padding: 15px 24px; vertical-align: middle; }

/* Order ID */
.order-id {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 400;
    color: var(--deep-rose); letter-spacing: 0.05em;
}

/* Total */
.price-cell {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px; font-weight: 400; color: var(--dark);
}
.price-cell small {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; letter-spacing: 1.5px;
    color: var(--muted); margin-left: 4px;
}

/* Date */
.date-cell { font-size: 12px; color: var(--muted); letter-spacing: 0.5px; }

/* ═══════════════════
   STATUS BADGES
═══════════════════ */
.badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 12px; border-radius: 20px;
    font-size: 10px; letter-spacing: 0.8px;
    font-weight: 500; text-transform: uppercase; white-space: nowrap;
}
.badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }

.badge-pending   { background: rgba(201,169,110,0.12); color: #a07830; border: 1px solid rgba(201,169,110,0.25); }
.badge-pending   .badge-dot { background: var(--gold); }
.badge-confirmed { background: rgba(59,130,246,0.09); color: #3b5bdb; border: 1px solid rgba(59,130,246,0.2); }
.badge-confirmed .badge-dot { background: #3b82f6; }
.badge-shipped   { background: rgba(139,92,246,0.09); color: #7048e8; border: 1px solid rgba(139,92,246,0.2); }
.badge-shipped   .badge-dot { background: #8b5cf6; }
.badge-success   { background: rgba(107,175,146,0.10); color: #2e8a58; border: 1px solid rgba(107,175,146,0.22); }
.badge-success   .badge-dot { background: #6BAF92; }
.badge-cancelled { background: rgba(196,116,138,0.09); color: var(--deep-rose); border: 1px solid rgba(196,116,138,0.2); }
.badge-cancelled .badge-dot { background: var(--deep-rose); }

/* ═══════════════════
   ACTION BUTTONS
═══════════════════ */
.actions-cell { display: flex; align-items: center; gap: 7px; flex-wrap: nowrap; }

.action-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 13px; border-radius: 7px;
    font-family: 'Raleway', sans-serif;
    font-size: 10px; letter-spacing: 0.5px;
    font-weight: 500;
    cursor: pointer; border: 1px solid transparent;
    text-decoration: none; background: transparent;
    transition: all .2s; white-space: nowrap;
}
.action-btn svg {
    width: 11px; height: 11px; fill: none; stroke: currentColor;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0;
}

/* View */
.btn-view {
    color: var(--deep-rose);
    border-color: rgba(196,116,138,0.25);
    background: rgba(196,116,138,0.06);
}
.btn-view:hover {
    background: rgba(196,116,138,0.14);
    border-color: var(--deep-rose);
    box-shadow: 0 2px 10px rgba(196,116,138,0.15);
}

/* Pay */
.btn-pay {
    color: #2e8a58;
    border-color: rgba(60,160,100,0.25);
    background: rgba(60,160,100,0.06);
}
.btn-pay:hover {
    background: rgba(60,160,100,0.14);
    border-color: rgba(60,160,100,0.45);
    box-shadow: 0 2px 10px rgba(60,160,100,0.12);
}

/* Edit */
.btn-edit {
    color: var(--gold);
    border-color: rgba(201,169,110,0.25);
    background: var(--gold-dim);
}
.btn-edit:hover {
    background: rgba(201,169,110,0.16);
    border-color: rgba(201,169,110,0.45);
}

/* Cancel */
.btn-cancel {
    color: #b36a20;
    border-color: rgba(179,106,32,0.22);
    background: rgba(179,106,32,0.05);
}
.btn-cancel:hover {
    background: rgba(179,106,32,0.12);
    border-color: rgba(179,106,32,0.40);
}

/* Delete */
.btn-delete {
    color: #c04040;
    border-color: rgba(190,70,70,0.22);
    background: rgba(190,70,70,0.04);
}
.btn-delete:hover {
    background: rgba(190,70,70,0.12);
    border-color: rgba(190,70,70,0.40);
}

/* ═══════════════════
   EMPTY STATE
═══════════════════ */
.empty-state {
    display: flex; flex-direction: column;
    align-items: center; padding: 72px 24px; gap: 10px;
    text-align: center;
}
.empty-icon { font-size: 44px; opacity: .4; margin-bottom: 6px; }
.empty-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px; font-weight: 300; color: var(--dark);
}
.empty-sub { font-size: 10px; color: var(--muted); letter-spacing: 2px; text-transform: uppercase; }
.empty-link {
    margin-top: 14px;
    display: inline-flex; align-items: center; gap: 8px;
    padding: 11px 24px; border-radius: 8px;
    border: 1px solid var(--border); color: var(--gold);
    font-size: 11px; letter-spacing: 1px; text-transform: uppercase;
    text-decoration: none; background: var(--white);
    transition: all .2s;
}
.empty-link:hover {
    background: var(--gold-dim); border-color: rgba(201,169,110,0.35);
    box-shadow: 0 4px 14px rgba(201,169,110,0.12);
}

/* ═══════════════════
   MODAL
═══════════════════ */
.modal-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(44,33,24,0.50);
    backdrop-filter: blur(5px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.modal-overlay.open { display: flex; }

.modal {
    background: var(--panel-bg);
    border: 1px solid var(--border);
    border-radius: 18px;
    width: 100%; max-width: 480px;
    box-shadow: 0 28px 64px rgba(44,33,24,0.20);
    overflow: hidden;
    animation: modalIn .3s cubic-bezier(0.22,1,0.36,1);
    position: relative;
}
.modal::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold));
}
@keyframes modalIn {
    from { opacity:0; transform:translateY(24px) scale(0.97); }
    to   { opacity:1; transform:translateY(0) scale(1); }
}

.modal-head {
    padding: 28px 32px 20px;
    border-bottom: 1px solid var(--border-s);
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: 14px;
}
.modal-head-left { display: flex; align-items: center; gap: 13px; }
.modal-icon {
    width: 46px; height: 46px; border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.modal-icon.gold { background: rgba(201,169,110,0.12); }
.modal-icon.red  { background: rgba(190,70,70,0.10); }
.modal-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px; font-weight: 300; color: var(--dark); line-height: 1.1;
}
.modal-sub { font-size: 11.5px; color: var(--muted); margin-top: 3px; }

.modal-close {
    width: 30px; height: 30px;
    border: 1px solid var(--border-s); border-radius: 50%;
    background: transparent; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--muted); font-size: 14px; flex-shrink: 0;
    transition: all .2s;
}
.modal-close:hover { border-color: var(--gold); color: var(--gold); }

.modal-body { padding: 22px 32px; }

/* Form */
.form-group { margin-bottom: 18px; }
.form-label {
    display: block;
    font-size: 9px; letter-spacing: 2.5px;
    text-transform: uppercase; color: var(--muted); margin-bottom: 8px;
}
.select-wrap { position: relative; }
.select-wrap::after {
    content: ''; position: absolute;
    right: 14px; top: 50%; transform: translateY(-50%);
    border: 5px solid transparent;
    border-top-color: var(--muted); pointer-events: none;
}
.form-select {
    width: 100%; padding: 11px 36px 11px 14px;
    background: var(--cream); border: 1px solid var(--border);
    border-radius: 9px;
    font-family: 'Raleway', sans-serif;
    font-size: 13px; color: var(--text);
    outline: none; transition: border-color .2s; appearance: none;
}
.form-select:focus { border-color: var(--gold); }

/* Delete warning */
.delete-warning {
    background: rgba(196,116,138,0.06);
    border: 1px solid rgba(196,116,138,0.18);
    border-radius: 10px; padding: 15px 17px;
    font-size: 13px; color: var(--text); line-height: 1.65;
}
.delete-warning strong { color: var(--deep-rose); font-weight: 500; }

.modal-foot {
    padding: 14px 32px 26px;
    display: flex; gap: 10px; justify-content: flex-end;
}
.btn-modal {
    padding: 10px 22px; border-radius: 9px;
    font-family: 'Raleway', sans-serif;
    font-size: 10.5px; letter-spacing: 1px;
    text-transform: uppercase; font-weight: 500;
    cursor: pointer; border: 1px solid transparent;
    transition: all .2s;
}
.btn-ghost {
    background: transparent; border-color: var(--border); color: var(--muted);
}
.btn-ghost:hover { border-color: var(--gold); color: var(--gold); }
.btn-gold {
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    color: #fff; box-shadow: 0 4px 14px rgba(201,169,110,0.25);
}
.btn-gold:hover { opacity: .9; box-shadow: 0 6px 20px rgba(201,169,110,0.35); }
.btn-red {
    background: #c04040; border-color: #c04040; color: #fff;
    box-shadow: 0 4px 14px rgba(190,70,70,0.2);
}
.btn-red:hover { background: #a03030; border-color: #a03030; }

/* ═══════════════════
   ANIMATIONS
═══════════════════ */
.fu { opacity:0; transform:translateY(14px); animation: fadeUp .45s cubic-bezier(.22,1,.36,1) forwards; }
.d1{animation-delay:.05s}.d2{animation-delay:.12s}.d3{animation-delay:.19s}.d4{animation-delay:.26s}
@keyframes fadeUp { to { opacity:1; transform:translateY(0); } }

/* ═══════════════════
   RESPONSIVE
═══════════════════ */
@media(max-width:768px) {
    .orders-hero  { padding: 28px 18px; flex-direction: column; align-items: flex-start; }
    .orders-content { padding: 24px 18px; }
    .orders-topbar  { padding: 0 18px; }
    .hero-pills { width: 100%; }
    table { display:block; overflow-x:auto; white-space:nowrap; }
    .action-btn span { display: none; }
    .action-btn { padding: 8px; border-radius: 8px; }
}
</style>

<div class="orders-page">

    {{-- ── TOP BAR ── --}}
    <header class="orders-topbar fu d1">
        <div class="tb-left">
            <a href="{{ route('client.dashboard') }}" class="tb-back">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Dashboard
            </a>
            <div class="tb-brand">
                <div class="tb-circle">Lh</div>
                <span class="tb-name">Lady's <em>Home</em></span>
            </div>
        </div>
        <div class="tb-right">
            <span class="tb-count">{{ $orders->count() }} commande(s)</span>
        </div>
    </header>

    {{-- ── HERO ── --}}
    <div class="orders-hero fu d1">
        <div class="hero-left">
            <p class="hero-eyebrow">Lady's Home · Suivi</p>
            <h1 class="hero-title">Mes <em>Commandes</em></h1>
            <p class="hero-sub">Retrouvez l'historique et le suivi de vos achats</p>
        </div>
        <div class="hero-pills">
            <div class="hero-pill">
                <p>Total</p>
                <span>{{ $orders->count() }}</span>
            </div>
            <div class="hero-pill">
                <p>En attente</p>
                <span>{{ $orders->where('status','pending')->count() }}</span>
            </div>
            <div class="hero-pill">
                <p>Livrées</p>
                <span>{{ $orders->where('status','completed')->count() }}</span>
            </div>
        </div>
    </div>

    {{-- ── CONTENT ── --}}
    <div class="orders-content">

        <div class="gold-divider fu d2">
            <span></span><i></i><i></i><i></i><span></span>
        </div>

        <div class="orders-card fu d3">

            <div class="card-head">
                <h2>Historique des <em>achats</em></h2>
            </div>

            @if($orders->count() > 0)

            <table>
                <thead>
                    <tr>
                        <th>Commande</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="fu d4">

                        {{-- ID --}}
                        <td>
                            <span class="order-id">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>

                        {{-- Total --}}
                        <td>
                            <span class="price-cell">
                                {{ number_format($order->total, 0, ',', ' ') }}<small>FCFA</small>
                            </span>
                        </td>

                        {{-- Statut --}}
                        <td>
                            @php
                                $badgeMap = [
                                    'pending'   => ['class'=>'badge-pending',   'dot'=>'','label'=>'En attente'],
                                    'confirmed' => ['class'=>'badge-confirmed', 'dot'=>'','label'=>'Confirmée'],
                                    'shipped'   => ['class'=>'badge-shipped',   'dot'=>'','label'=>'Expédiée'],
                                    'completed' => ['class'=>'badge-success',   'dot'=>'','label'=>'Livrée'],
                                    'cancelled' => ['class'=>'badge-cancelled', 'dot'=>'','label'=>'Annulée'],
                                ];
                                $b = $badgeMap[$order->status] ?? ['class'=>'badge-pending','dot'=>'','label'=>ucfirst($order->status)];
                            @endphp
                            <span class="badge {{ $b['class'] }}">
                                <span class="badge-dot"></span>
                                {{ $b['label'] }}
                            </span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <span class="date-cell">{{ $order->created_at->format('d/m/Y') }}</span>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="actions-cell">

                                {{-- Voir --}}
                                <a href="{{ route('client.orders.show', $order->id) }}" class="action-btn btn-view" title="Voir">
                                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <span>Voir</span>
                                </a>

                                {{-- Payer --}}
                                @if($order->status == 'pending')
                                <a href="{{ route('checkout', $order->id) }}" class="action-btn btn-pay" title="Payer">
                                    <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    <span>Payer</span>
                                </a>
                                @endif

                                {{-- Modifier --}}
                                @if($order->status == 'pending')
                                <button
                                    class="action-btn btn-edit"
                                    onclick="openEditModal({{ $order->id }}, '{{ $order->status }}')"
                                    title="Modifier">
                                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    <span>Modifier</span>
                                </button>
                                @endif

                                {{-- Annuler --}}
                                @if(in_array($order->status, ['pending','shipped']))
                                <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" style="margin:0">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-btn btn-cancel" title="Annuler">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                        <span>Annuler</span>
                                    </button>
                                </form>
                                @endif

                                {{-- Supprimer --}}
                                @if(in_array($order->status, ['cancelled','completed']))
                                <button
                                    class="action-btn btn-delete"
                                    onclick="openDeleteModal({{ $order->id }}, '#{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }}')"
                                    title="Supprimer">
                                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    <span>Supprimer</span>
                                </button>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <div class="empty-state">
                <span class="empty-icon">📭</span>
                <p class="empty-text">Aucune commande pour le moment</p>
                <span class="empty-sub">Commencez vos achats dès maintenant</span>
                <a href="{{ route('products.index') }}" class="empty-link">Explorer les produits →</a>
            </div>
            @endif

        </div>{{-- /card --}}
    </div>{{-- /content --}}
</div>{{-- /page --}}

{{-- ══ MODAL MODIFIER ══ --}}
<div class="modal-overlay" id="editModal">
    <div class="modal">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-icon gold">✏️</div>
                <div>
                    <h2 class="modal-title">Modifier la commande</h2>
                    <p class="modal-sub" id="editModalSub">Commande #0001</p>
                </div>
            </div>
            <button class="modal-close" onclick="closeModal('editModal')">✕</button>
        </div>
        <div class="modal-body">
            <form id="editForm" method="POST">
                @csrf @method('PATCH')
                <div class="form-group">
                    <label class="form-label">Statut de la commande</label>
                    <div class="select-wrap">
                        <select name="status" class="form-select" id="editStatusSelect">
                            <option value="pending">⏳ En attente</option>
                            <option value="confirmed">✅ Confirmée</option>
                            <option value="shipped">🚚 Expédiée</option>
                            <option value="completed">📦 Livrée</option>
                            <option value="cancelled">✖ Annulée</option>
                        </select>
                    </div>
                </div>
                <div class="modal-foot" style="padding:0;margin-top:4px">
                    <button type="button" class="btn-modal btn-ghost" onclick="closeModal('editModal')">Annuler</button>
                    <button type="submit" class="btn-modal btn-gold">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ MODAL SUPPRIMER ══ --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-icon red">🗑️</div>
                <div>
                    <h2 class="modal-title">Supprimer la commande</h2>
                    <p class="modal-sub" id="deleteModalSub">Commande #0001</p>
                </div>
            </div>
            <button class="modal-close" onclick="closeModal('deleteModal')">✕</button>
        </div>
        <div class="modal-body">
            <div class="delete-warning">
                Vous êtes sur le point de supprimer la commande <strong id="deleteOrderRef">#0001</strong>.
                Cette action est <strong>irréversible</strong> et supprimera définitivement cette commande de votre historique.
            </div>
        </div>
        <div class="modal-foot">
            <button type="button" class="btn-modal btn-ghost" onclick="closeModal('deleteModal')">Annuler</button>
            <form id="deleteForm" method="POST" style="margin:0">
                @csrf @method('DELETE')
                <button type="submit" class="btn-modal btn-red">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(orderId, currentStatus) {
    document.getElementById('editModalSub').textContent = 'Commande #' + String(orderId).padStart(4,'0');
    document.getElementById('editForm').action = '/orders/' + orderId;
    document.getElementById('editStatusSelect').value = currentStatus;
    document.getElementById('editModal').classList.add('open');
}

function openDeleteModal(orderId, ref) {
    document.getElementById('deleteModalSub').textContent = 'Commande ' + ref;
    document.getElementById('deleteOrderRef').textContent = ref;
    document.getElementById('deleteForm').action = '/orders/' + orderId;
    document.getElementById('deleteModal').classList.add('open');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

// Close on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('open');
    });
});

// Close on Escape
document.addEventListener('keydown', e => {
    if (e.key === 'Escape')
        document.querySelectorAll('.modal-overlay.open').forEach(m => m.classList.remove('open'));
});
</script>

@endsection
