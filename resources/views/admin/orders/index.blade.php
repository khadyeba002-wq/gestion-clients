
@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

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
    --dark-2:     #2A1419;
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
.admin-page { min-height: 100vh; display: flex; flex-direction: column; }

/* ═══════ TOPBAR ═══════ */
.admin-topbar {
    background: var(--white); border-bottom: 1px solid var(--border);
    height: 62px; display: flex; align-items: center; justify-content: space-between;
    padding: 0 40px; position: sticky; top: 0; z-index: 100;
}
.admin-topbar::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
    background-size: 200% 100%; animation: shimmer 3s linear infinite;
}
@keyframes shimmer { from { background-position: 200% 0; } to { background-position: -200% 0; } }

.tb-left { display: flex; align-items: center; gap: 14px; }
.tb-back {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 7px 15px; border-radius: 7px;
    border: 1px solid var(--border); background: transparent;
    color: var(--muted); font-size: 10px; letter-spacing: 1.5px;
    text-transform: uppercase; text-decoration: none; transition: all .2s;
}
.tb-back:hover { border-color: var(--gold); color: var(--gold); background: rgba(201,169,110,.06); }
.tb-back svg { width:12px; height:12px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; transition:transform .2s; }
.tb-back:hover svg { transform: translateX(-2px); }

.tb-brand { display: flex; align-items: center; gap: 9px; }
.tb-circle { width:34px; height:34px; border-radius:50%; border:1.5px solid var(--gold); display:flex; align-items:center; justify-content:center; font-family:'Cormorant Garamond',serif; font-style:italic; font-size:13px; color:var(--gold); }
.tb-name { font-family:'Cormorant Garamond',serif; font-size:16px; font-weight:300; color:var(--dark); }
.tb-name em { color:var(--deep-rose); font-style:italic; }

/* ═══════ HERO ═══════ */
.admin-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
    padding: 36px 40px; display: flex; align-items: flex-end; justify-content: space-between; gap: 24px;
    position: relative; overflow: hidden;
}
.admin-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:220px; height:220px; border-radius:50%; background:radial-gradient(circle,rgba(232,160,176,0.15),transparent 70%); pointer-events:none; }
.hero-left p.ey { font-size:9px; letter-spacing:5px; text-transform:uppercase; color:var(--gold-light); margin-bottom:8px; }
.hero-left h1 { font-family:'Cormorant Garamond',serif; font-size:32px; font-weight:300; color:#fff; line-height:1; margin-bottom:6px; }
.hero-left h1 em { font-style:italic; color:var(--rose); }
.hero-left p.sub { font-size:11px; color:rgba(255,255,255,0.32); letter-spacing:.5px; }

.hero-pills { display:flex; gap:12px; flex-wrap:wrap; }
.hero-pill { background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1); border-radius:10px; padding:12px 18px; text-align:center; min-width:80px; }
.hero-pill p { font-size:8px; letter-spacing:2.5px; text-transform:uppercase; color:var(--gold-light); margin-bottom:6px; }
.hero-pill span { font-family:'Cormorant Garamond',serif; font-size:26px; font-weight:300; color:#fff; line-height:1; }

/* ═══════ CONTENT ═══════ */
.admin-content { flex:1; padding:32px 40px 60px; }

/* Gold divider */
.gold-div { display:flex; align-items:center; gap:10px; margin-bottom:26px; }
.gold-div span { height:1px; }
.gold-div span:first-child { width:34px; background:linear-gradient(to right,var(--deep-rose),var(--gold)); }
.gold-div span:last-child { flex:1; background:linear-gradient(to right,rgba(201,169,110,.18),transparent); }
.gold-div i { width:4px; height:4px; border-radius:50%; background:var(--gold); display:inline-block; }

/* Stats bar */
.stats-bar { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:24px; }
.stat-pill { background:var(--white); border:1px solid var(--border); border-radius:14px; padding:16px 18px; display:flex; align-items:center; gap:12px; position:relative; overflow:hidden; transition:transform .2s,box-shadow .2s; }
.stat-pill::before { content:''; position:absolute; top:0; left:0; width:3px; height:100%; background:linear-gradient(180deg,var(--deep-rose),var(--gold)); }
.stat-pill:hover { transform:translateY(-3px); box-shadow:0 10px 24px rgba(196,116,138,.1); }
.stat-ico { width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:17px; flex-shrink:0; }
.stat-info p { font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--muted); margin-bottom:4px; }
.stat-info span { font-family:'Cormorant Garamond',serif; font-size:26px; font-weight:400; color:var(--dark); line-height:1; }

/* Card */
.orders-card { background:var(--white); border-radius:16px; border:1px solid var(--border); overflow:hidden; }
.orders-card::before { content:''; display:block; height:2px; background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent); }
.card-head { display:flex; align-items:center; justify-content:space-between; padding:16px 22px; border-bottom:1px solid var(--border); background:rgba(248,240,237,.45); }
.card-head h3 { font-family:'Cormorant Garamond',serif; font-size:19px; font-weight:400; color:var(--dark); }
.card-head h3 em { color:var(--deep-rose); font-style:italic; }
.order-count { font-size:10px; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted); }

/* Table */
table { width:100%; border-collapse:collapse; }
thead th { text-align:left; font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--muted); font-weight:400; padding:12px 20px; border-bottom:1px solid var(--border); background:rgba(248,240,237,.5); white-space:nowrap; }
tbody tr { border-bottom:1px solid rgba(196,116,138,.06); transition:background .18s; }
tbody tr:last-child { border-bottom:none; }
tbody tr:hover { background:rgba(242,196,206,.1); }
tbody td { padding:14px 20px; font-size:13px; vertical-align:middle; }

/* Cells */
.order-id-cell { font-family:'Cormorant Garamond',serif; font-size:17px; color:var(--deep-rose); }
.client-cell { display:flex; align-items:center; gap:10px; }
.client-av { width:33px; height:33px; border-radius:50%; background:linear-gradient(135deg,rgba(242,196,206,.45),rgba(201,169,110,.25)); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-family:'Cormorant Garamond',serif; font-style:italic; font-size:14px; color:var(--deep-rose); flex-shrink:0; }
.client-info p { font-size:13px; font-weight:500; color:var(--dark); line-height:1; margin-bottom:2px; }
.client-info small { font-size:10.5px; color:var(--muted); }
.price-cell { font-family:'Cormorant Garamond',serif; font-size:17px; color:var(--dark); }
.price-cell small { font-family:'Raleway',sans-serif; font-size:9px; color:var(--muted); letter-spacing:1.5px; margin-left:3px; }

/* Status select */
.status-wrap { position:relative; display:inline-block; }
.status-select {
    appearance:none; -webkit-appearance:none; border:none; outline:none; cursor:pointer;
    font-family:'Raleway',sans-serif; font-size:10.5px; font-weight:500; letter-spacing:.3px;
    padding:5px 26px 5px 11px; border-radius:20px; transition:all .2s;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%239C7A80' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 8px center;
}
.s-pending   { background-color:var(--gold-pale);  color:#8A6A30; }
.s-confirmed { background-color:#EEF2FD; color:#3455A4; }
.s-shipped   { background-color:#F0EAF8; color:#7B3FA0; }
.s-delivered { background-color:#E8F5F0; color:#2E7D5F; }
.s-cancelled { background-color:#FEF0F0; color:#C62828; }

/* View btn */
.view-btn { display:inline-flex; align-items:center; gap:6px; color:var(--deep-rose); text-decoration:none; font-size:10.5px; font-weight:400; letter-spacing:1.5px; text-transform:uppercase; padding:6px 14px; border:1px solid rgba(196,116,138,.28); background:rgba(196,116,138,.05); border-radius:7px; transition:all .2s; }
.view-btn:hover { background:rgba(196,116,138,.12); border-color:var(--deep-rose); }

/* Empty */
.empty-state { padding:56px 24px; text-align:center; }
.empty-state .empty-ico { font-size:38px; margin-bottom:14px; opacity:.45; }
.empty-state p { font-family:'Cormorant Garamond',serif; font-style:italic; font-size:20px; color:var(--muted); }
.empty-state small { font-size:10px; color:rgba(156,122,128,.6); letter-spacing:2px; text-transform:uppercase; display:block; margin-top:5px; }

/* Animations */
.fu { opacity:0; transform:translateY(14px); animation:fadeUp .48s ease forwards; }
.d1{animation-delay:.04s}.d2{animation-delay:.10s}.d3{animation-delay:.17s}.d4{animation-delay:.24s}.d5{animation-delay:.31s}
@keyframes fadeUp { to { opacity:1; transform:translateY(0); } }

@media(max-width:1024px){ .stats-bar{grid-template-columns:1fr 1fr;} }
@media(max-width:768px){ .admin-hero{flex-direction:column;align-items:flex-start;} .admin-content{padding:22px 18px;} .admin-topbar{padding:0 18px;} table{display:block;overflow-x:auto;white-space:nowrap;} }
</style>

<div class="admin-page">

    {{-- TOPBAR --}}
    <header class="admin-topbar fu d1">
        <div class="tb-left">
            <a href="{{ route('admin.dashboard') }}" class="tb-back">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Dashboard
            </a>
            <div class="tb-brand">
                <div class="tb-circle">Lh</div>
                <span class="tb-name">Lady's <em>Home</em></span>
            </div>
        </div>
    </header>

    {{-- HERO --}}
    <div class="admin-hero fu d1">
        <div class="hero-left">
            <p class="ey">Admin · Gestion</p>
            <h1>Suivi des <em>Commandes</em></h1>
            <p class="sub">Gérez et mettez à jour le statut de chaque commande</p>
        </div>
        <div class="hero-pills">
            <div class="hero-pill"><p>Total</p><span>{{ $orders->count() }}</span></div>
            <div class="hero-pill"><p>En attente</p><span>{{ $orders->where('status','pending')->count() }}</span></div>
            <div class="hero-pill"><p>Expédiées</p><span>{{ $orders->where('status','shipped')->count() }}</span></div>
            <div class="hero-pill"><p>Livrées</p><span>{{ $orders->where('status','delivered')->count() }}</span></div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="admin-content">

        <div class="gold-div fu d2"><span></span><i></i><i></i><i></i><span></span></div>

        {{-- STATS --}}
        <div class="stats-bar fu d2">
            <div class="stat-pill">
                <div class="stat-ico" style="background:linear-gradient(135deg,rgba(242,196,206,.3),rgba(201,169,110,.2))">📋</div>
                <div class="stat-info"><p>Total</p><span>{{ $orders->count() }}</span></div>
            </div>
            <div class="stat-pill">
                <div class="stat-ico" style="background:linear-gradient(135deg,var(--gold-pale),#EEE0C0)">⏳</div>
                <div class="stat-info"><p>En attente</p><span>{{ $orders->where('status','pending')->count() }}</span></div>
            </div>
            <div class="stat-pill">
                <div class="stat-ico" style="background:linear-gradient(135deg,#EEF2FD,#D0DEFB)">🚚</div>
                <div class="stat-info"><p>Expédiées</p><span>{{ $orders->where('status','shipped')->count() }}</span></div>
            </div>
            <div class="stat-pill">
                <div class="stat-ico" style="background:linear-gradient(135deg,#E8F5F0,#C8E8DC)">✅</div>
                <div class="stat-info"><p>Livrées</p><span>{{ $orders->where('status','delivered')->count() }}</span></div>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="orders-card fu d3">
            <div class="card-head">
                <h3>Liste des <em>Commandes</em></h3>
                <span class="order-count">{{ $orders->count() }} commande{{ $orders->count()>1?'s':'' }}</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th style="text-align:right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><span class="order-id-cell">#{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }}</span></td>

                        <td>
                            <div class="client-cell">
                                <div class="client-av">{{ strtoupper(substr($order->user->name??'C',0,1)) }}</div>
                                <div class="client-info">
                                    <p>{{ $order->user->name ?? 'N/A' }}</p>
                                    <small>{{ $order->user->email ?? '' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="price-cell">
                                {{ number_format($order->total,0,',',' ') }}<small>DZD</small>
                            </span>
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="margin:0">
                                @csrf @method('PUT')
                                <div class="status-wrap">
                                    <select name="status"
                                            onchange="this.form.submit(); this.className='status-select s-'+this.value"
                                            class="status-select s-{{ $order->status }}">
                                        @foreach(['pending'=>'⏳ En attente','confirmed'=>'✅ Confirmée','shipped'=>'🚚 Expédiée','delivered'=>'📦 Livrée','cancelled'=>'✖ Annulée'] as $val=>$label)
                                            <option value="{{ $val }}" {{ $order->status==$val?'selected':'' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </td>

                        <td style="text-align:right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="view-btn">
                                Voir →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-ico">📭</div>
                                <p>Aucune commande pour le moment</p>
                                <small>Les nouvelles commandes apparaîtront ici</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>{{-- /admin-content --}}
</div>

<script>
document.querySelectorAll('.status-select').forEach(sel => {
    sel.addEventListener('change', function() {
        this.className = 'status-select s-' + this.value;
    });
});
</script>

@endsection
