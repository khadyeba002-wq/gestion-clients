
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
    --gold-pale:  #FAF3E8;
    --dark:       #3A2028;
    --text:       #4A2E34;
    --muted:      #9C7A80;
    --white:      #FFFAF8;
    --bg:         #F8F0ED;
    --border:     rgba(196,116,138,0.13);
    --border-s:   rgba(196,116,138,0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { font-family: 'Raleway', sans-serif; background: var(--bg); color: var(--text); }
body > *, .container, .container-fluid, #app, [class*="wrapper"] {
    max-width: none !important; padding: 0 !important; margin: 0 !important; width: 100% !important;
}

/* ═══════ PAGE ═══════ */
.show-page { min-height: 100vh; display: flex; flex-direction: column; }

/* ═══════ TOPBAR ═══════ */
.show-topbar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    height: 62px;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 40px;
    position: sticky; top: 0; z-index: 100;
}
.show-topbar::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
    background-size: 200% 100%;
    animation: shimmer 3s linear infinite;
}
@keyframes shimmer { from { background-position: 200% 0; } to { background-position: -200% 0; } }

.tb-left { display: flex; align-items: center; gap: 14px; }
.tb-back {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 7px 15px; border-radius: 7px;
    border: 1px solid var(--border); background: transparent;
    color: var(--muted); font-size: 10px; letter-spacing: 1.5px;
    text-transform: uppercase; text-decoration: none;
    transition: all .2s;
}
.tb-back:hover { border-color: var(--gold); color: var(--gold); background: rgba(201,169,110,.06); }
.tb-back svg { width:12px; height:12px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; transition:transform .2s; }
.tb-back:hover svg { transform: translateX(-2px); }

.tb-brand { display: flex; align-items: center; gap: 9px; }
.tb-circle {
    width: 34px; height: 34px; border-radius: 50%;
    border: 1.5px solid var(--gold);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 13px; color: var(--gold);
}
.tb-name { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 300; color: var(--dark); }
.tb-name em { color: var(--deep-rose); font-style: italic; }

.tb-order-ref {
    font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
    color: var(--muted); background: var(--gold-light);
    padding: 4px 12px; border-radius: 20px; opacity: .75;
}

/* ═══════ HERO ═══════ */
.show-hero {
    background: linear-gradient(135deg, var(--dark) 0%, #5A2830 100%);
    padding: 36px 40px;
    display: flex; align-items: flex-end; justify-content: space-between; gap: 24px;
    position: relative; overflow: hidden;
}
.show-hero::before {
    content: ''; position: absolute; top: -80px; right: -60px;
    width: 220px; height: 220px; border-radius: 50%;
    background: radial-gradient(circle, rgba(232,160,176,0.16), transparent 70%);
    pointer-events: none;
}
.hero-left p.ey { font-size: 9px; letter-spacing: 5px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 8px; }
.hero-left h1 { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 300; color: #fff; line-height: 1; margin-bottom: 14px; }
.hero-left h1 em { font-style: italic; color: var(--rose); }

/* Client info inline */
.hero-client { display: flex; align-items: center; gap: 10px; }
.hero-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, var(--blush), var(--rose));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 15px; color: #fff; flex-shrink: 0;
}
.hero-client-info p { font-size: 13px; font-weight: 500; color: #fff; line-height: 1; margin-bottom: 3px; }
.hero-client-info small { font-size: 10px; color: rgba(255,255,255,.4); letter-spacing: .5px; }

/* Status badge */
.hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 7px 16px; border-radius: 20px;
    font-size: 11px; font-weight: 500; letter-spacing: .5px;
    margin-top: 14px;
}
.hero-badge .hb-dot { width: 7px; height: 7px; border-radius: 50%; }
.st-pending   { background: rgba(201,169,110,0.2);  color: var(--gold-light); }
.st-pending   .hb-dot { background: var(--gold-light); }
.st-confirmed { background: rgba(59,130,246,0.2);   color: #93C5FD; }
.st-confirmed .hb-dot { background: #93C5FD; }
.st-shipped   { background: rgba(139,92,246,0.2);   color: #C4B5FD; }
.st-shipped   .hb-dot { background: #C4B5FD; }
.st-delivered { background: rgba(107,175,146,0.2);  color: #6EE7B7; }
.st-delivered .hb-dot { background: #6EE7B7; }
.st-cancelled { background: rgba(239,68,68,0.2);    color: #FCA5A5; }
.st-cancelled .hb-dot { background: #FCA5A5; }

/* Total box */
.hero-total {
    text-align: center;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px; padding: 18px 28px; flex-shrink: 0;
}
.hero-total p { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 7px; }
.hero-total .amount { font-family: 'Cormorant Garamond', serif; font-size: 34px; font-weight: 300; color: #fff; line-height: 1; }
.hero-total .cur { font-size: 11px; color: var(--gold-light); letter-spacing: 2px; margin-top: 4px; }

/* ═══════ CONTENT ═══════ */
.show-content { flex: 1; padding: 36px 40px 60px; display: flex; flex-direction: column; gap: 22px; }

/* ═══════ STATUS FORM CARD ═══════ */
.status-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
}
.status-card::before { content: ''; display: block; height: 2px; background: linear-gradient(to right, var(--deep-rose), var(--gold), transparent); }
.sc-head { display: flex; align-items: center; justify-content: space-between; padding: 16px 24px; border-bottom: 1px solid var(--border-s); }
.sc-head h3 { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 400; color: var(--dark); }
.sc-head h3 em { color: var(--deep-rose); font-style: italic; }
.sc-body { padding: 20px 24px; display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }

.status-select-wrap { position: relative; }
.status-select-wrap::after {
    content: ''; position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    border: 5px solid transparent; border-top-color: var(--muted); pointer-events: none;
}
.status-select {
    appearance: none; -webkit-appearance: none;
    padding: 10px 36px 10px 14px; border-radius: 9px;
    border: 1px solid var(--border); outline: none;
    font-family: 'Raleway', sans-serif; font-size: 12.5px; color: var(--text);
    background: var(--bg); cursor: pointer;
    transition: border-color .2s; min-width: 200px;
}
.status-select:focus { border-color: var(--gold); }

.btn-update {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: 9px;
    background: linear-gradient(135deg, var(--deep-rose), var(--gold));
    color: #fff; border: none;
    font-family: 'Raleway', sans-serif; font-size: 10px;
    font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(196,116,138,0.25);
    transition: opacity .2s, transform .2s;
}
.btn-update:hover { opacity: .9; transform: translateY(-1px); }

/* ═══════ TRACKER ═══════ */
.tracker-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
}
.tracker-card::before { content: ''; display: block; height: 2px; background: linear-gradient(to right, var(--deep-rose), var(--gold), transparent); }
.tc-head { padding: 16px 24px; border-bottom: 1px solid var(--border-s); }
.tc-head h3 { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 400; color: var(--dark); }
.tc-head h3 em { color: var(--deep-rose); font-style: italic; }
.tracker { display: flex; align-items: flex-start; padding: 22px 24px; }
.track-step { flex: 1; display: flex; flex-direction: column; align-items: center; text-align: center; position: relative; }
.track-step:not(:last-child)::after {
    content: ''; position: absolute; top: 14px;
    left: calc(50% + 15px); right: calc(-50% + 15px);
    height: 2px; background: var(--border);
}
.track-step.done:not(:last-child)::after { background: linear-gradient(to right, var(--gold), var(--rose)); }
.track-dot {
    width: 28px; height: 28px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; margin-bottom: 9px;
    position: relative; z-index: 1;
    border: 2px solid var(--border); background: var(--bg); color: var(--muted);
}
.track-step.done .track-dot { background: linear-gradient(135deg, var(--deep-rose), var(--gold)); border-color: transparent; color: #fff; box-shadow: 0 4px 12px rgba(196,116,138,0.28); }
.track-step.current .track-dot { background: var(--white); border-color: var(--gold); color: var(--gold); box-shadow: 0 0 0 4px rgba(201,169,110,0.15); }
.track-label { font-size: 10.5px; color: var(--muted); line-height: 1.4; max-width: 80px; }
.track-step.done .track-label { color: var(--dark); font-weight: 500; }
.track-step.current .track-label { color: var(--gold); font-weight: 500; }

/* ═══════ ITEMS CARD ═══════ */
.items-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
}
.items-card::before { content: ''; display: block; height: 2px; background: linear-gradient(to right, var(--deep-rose), var(--gold), transparent); }
.ic-head { display: flex; align-items: center; justify-content: space-between; padding: 16px 24px; border-bottom: 1px solid var(--border-s); }
.ic-head h3 { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 400; color: var(--dark); }
.ic-head h3 em { color: var(--deep-rose); font-style: italic; }
.ic-count { font-size: 10px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); background: var(--gold-light); padding: 3px 11px; border-radius: 20px; opacity: .7; }

table { width: 100%; border-collapse: collapse; }
thead th { text-align: left; font-size: 9px; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); font-weight: 400; padding: 12px 22px; border-bottom: 1px solid var(--border-s); background: rgba(248,240,237,.4); }
tbody tr { border-bottom: 1px solid rgba(196,116,138,0.06); transition: background .18s; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(242,196,206,.08); }
tbody td { padding: 14px 22px; vertical-align: middle; font-size: 13.5px; }

.prod-cell { display: flex; align-items: center; gap: 12px; }
.prod-thumb { width: 50px; height: 50px; border-radius: 9px; overflow: hidden; flex-shrink: 0; background: var(--bg); border: 1px solid var(--border); }
.prod-thumb img { width: 100%; height: 100%; object-fit: cover; }
.prod-thumb-lh { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--deep-rose), var(--gold)); font-family: 'Cormorant Garamond', serif; font-size: 13px; font-style: italic; color: #fff; font-weight: 600; }
.prod-name { font-size: 13.5px; font-weight: 500; color: var(--dark); }
.prod-del  { font-size: 11px; color: var(--muted); font-style: italic; }
.price-v { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 400; color: var(--dark); }
.price-v small { font-family: 'Raleway', sans-serif; font-size: 9px; color: var(--muted); letter-spacing: 1.5px; margin-left: 3px; }
.qty-p { display: inline-flex; align-items: center; justify-content: center; width: 29px; height: 29px; border-radius: 7px; background: rgba(201,169,110,.1); font-size: 13px; font-weight: 600; color: var(--dark); }
.subtotal-v { font-family: 'Cormorant Garamond', serif; font-size: 17px; color: var(--deep-rose); }
.subtotal-v small { font-family: 'Raleway', sans-serif; font-size: 9px; color: var(--muted); letter-spacing: 1.5px; }

/* Empty row */
.empty-row td { padding: 52px 24px; text-align: center; font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 18px; color: var(--muted); }

/* ═══════ SUMMARY ═══════ */
.summary-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: 16px; padding: 22px 28px;
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
}
.summary-note { display: flex; align-items: flex-start; gap: 10px; }
.summary-note span { font-size: 18px; flex-shrink: 0; }
.summary-note p { font-size: 12px; color: var(--muted); line-height: 1.7; }
.summary-total { text-align: right; flex-shrink: 0; }
.summary-total p { font-size: 9px; letter-spacing: 2.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 5px; }
.summary-total .big { font-family: 'Cormorant Garamond', serif; font-size: 34px; font-weight: 300; color: var(--dark); line-height: 1; }
.summary-total .big em { font-family: 'Raleway', sans-serif; font-size: 12px; font-style: normal; color: var(--gold); letter-spacing: 1.5px; margin-left: 5px; }

/* ═══════ ANIMATIONS ═══════ */
.fu { opacity:0; transform:translateY(14px); animation: fadeUp .45s ease forwards; }
.d1{animation-delay:.05s}.d2{animation-delay:.12s}.d3{animation-delay:.19s}.d4{animation-delay:.26s}.d5{animation-delay:.33s}
@keyframes fadeUp { to { opacity:1; transform:translateY(0); } }

/* ═══════ RESPONSIVE ═══════ */
@media(max-width:700px) {
    .show-hero { flex-direction:column; align-items:flex-start; }
    .hero-total { width:100%; }
    .tracker { flex-direction:column; gap:12px; align-items:flex-start; }
    .track-step { flex-direction:row; text-align:left; gap:10px; }
    .track-step:not(:last-child)::after { display:none; }
    .track-label { max-width:none; }
    .show-content { padding:22px 18px; }
    .show-topbar { padding:0 18px; }
    .summary-card { flex-direction:column; align-items:flex-start; }
    .summary-total { text-align:left; }
}
</style>

<div class="show-page">

    {{-- TOP BAR --}}
    <header class="show-topbar fu d1">
        <div class="tb-left">
            <a href="{{ route('admin.orders.index') }}" class="tb-back">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Commandes
            </a>
            <div class="tb-brand">
                <div class="tb-circle">Lh</div>
                <span class="tb-name">Lady's <em>Home</em></span>
            </div>
        </div>
        <span class="tb-order-ref">Commande #{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }}</span>
    </header>

    {{-- HERO --}}
    <div class="show-hero fu d1">
        <div class="hero-left">
            <p class="ey">Admin · Détail commande</p>
            <h1>Commande <em>#{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }}</em></h1>
            <div class="hero-client">
                <div class="hero-avatar">{{ strtoupper(substr($order->user->name ?? 'C', 0, 1)) }}</div>
                <div class="hero-client-info">
                    <p>{{ $order->user->name ?? 'Client inconnu' }}</p>
                    <small>{{ $order->user->email ?? '' }}</small>
                </div>
            </div>
            @php
                $stMap = [
                    'pending'   => ['label'=>'⏳ En attente',  'cls'=>'st-pending'],
                    'confirmed' => ['label'=>'✅ Confirmée',   'cls'=>'st-confirmed'],
                    'shipped'   => ['label'=>'🚚 Expédiée',   'cls'=>'st-shipped'],
                    'delivered' => ['label'=>'📦 Livrée',     'cls'=>'st-delivered'],
                    'cancelled' => ['label'=>'✖ Annulée',     'cls'=>'st-cancelled'],
                ];
                $st = $stMap[$order->status] ?? ['label'=>ucfirst($order->status),'cls'=>'st-pending'];
            @endphp
            <div class="hero-badge {{ $st['cls'] }}">
                <div class="hb-dot"></div> {{ $st['label'] }}
            </div>
        </div>
        <div class="hero-total">
            <p>Total commande</p>
            <div class="amount">{{ number_format($order->total,0,',',' ') }}</div>
            <div class="cur">FCF</div>
        </div>
    </div>

    <div class="show-content">

        {{-- CHANGER STATUT --}}
        <div class="status-card fu d2">
            <div class="sc-head">
                <h3>Mettre à jour le <em>statut</em></h3>
            </div>
            <div class="sc-body">
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0">
                    @csrf @method('PUT')
                    <div class="status-select-wrap">
                        <select name="status" class="status-select">
                            @foreach(['pending'=>'⏳ En attente','confirmed'=>'✅ Confirmée','shipped'=>'🚚 Expédiée','delivered'=>'📦 Livrée','cancelled'=>'✖ Annulée'] as $val=>$label)
                                <option value="{{ $val }}" {{ $order->status==$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-update">Mettre à jour</button>
                </form>
            </div>
        </div>

        {{-- TRACKER --}}
        @if($order->status !== 'cancelled')
        @php
            $steps = ['pending','confirmed','shipped','delivered'];
            $idx = array_search($order->status, $steps);
            if($idx === false) $idx = 0;
        @endphp
        <div class="tracker-card fu d3">
            <div class="tc-head">
                <h3>Suivi de <em>livraison</em></h3>
            </div>
            <div class="tracker">
                @foreach([['pending','📋','Passée'],['confirmed','✅','Confirmée'],['shipped','🚚','Expédiée'],['delivered','📦','Livrée']] as $i=>[$val,$ico,$lbl])
                <div class="track-step {{ $i < $idx ? 'done' : ($i == $idx ? 'current' : '') }}">
                    <div class="track-dot">{{ $i < $idx ? '✓' : $ico }}</div>
                    <div class="track-label">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ARTICLES --}}
        <div class="items-card fu d4">
            <div class="ic-head">
                <h3>Articles <em>commandés</em></h3>
                <span class="ic-count">{{ $order->items->count() }} article(s)</span>
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
                    @forelse($order->items as $item)
                    <tr>
                        <td>
                            <div class="prod-cell">
                                <div class="prod-thumb">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="">
                                    @else
                                        <div class="prod-thumb-lh">Lh</div>
                                    @endif
                                </div>
                                <span class="{{ $item->product ? 'prod-name' : 'prod-del' }}">
                                    {{ $item->product->name ?? 'Produit supprimé' }}
                                </span>
                            </div>
                        </td>
                        <td><span class="price-v">{{ number_format($item->price,0,',',' ') }}<small>FCF</small></span></td>
                        <td><span class="qty-p">{{ $item->quantity }}</span></td>
                        <td><span class="subtotal-v">{{ number_format($item->price*$item->quantity,0,',',' ') }}<small>FCF</small></span></td>
                    </tr>
                    @empty
                    <tr class="empty-row"><td colspan="4">Aucun article trouvé</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- RÉSUMÉ --}}
        <div class="summary-card fu d5">
            <div class="summary-note">
                <span>📋</span>
                <p>Commande passée le {{ $order->created_at->format('d/m/Y à H:i') }}<br>
                Toute modification de statut est immédiatement notifiée à la cliente.</p>
            </div>
            <div class="summary-total">
                <p>Total général</p>
                <div class="big">{{ number_format($order->total,0,',',' ') }}<em>FCF</em></div>
            </div>
        </div>

    </div>{{-- /show-content --}}
</div>

@endsection
