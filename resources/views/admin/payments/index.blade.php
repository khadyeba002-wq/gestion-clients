{{-- resources/views/admin/payments/index.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--gold-pale:#FAF3E8;--dark:#3A2028;--dark-2:#2A1419;--text:#4A2E34;--muted:#9C7A80;--white:#FFFAF8;--bg:#F8F0ED;--border:rgba(196,116,138,0.13);}
    .admin-page{padding:28px 34px;font-family:'Raleway',sans-serif;color:var(--text);}
    .btn-back{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;font-weight:400;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s ease;margin-bottom:20px;opacity:0;animation:fadeUp .5s ease forwards .02s;}
    .btn-back:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);transform:translateX(-2px);}
    .btn-back svg{transition:transform .22s;}.btn-back:hover svg{transform:translateX(-3px);}
    .page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:400;margin-bottom:6px;opacity:0;animation:fadeUp .5s ease forwards .07s;}
    .page-title{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);line-height:1;letter-spacing:1px;opacity:0;animation:fadeUp .5s ease forwards .13s;}
    .page-title em{font-style:italic;color:var(--deep-rose);}
    .page-header-row{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;}
    .gold-div{display:flex;align-items:center;gap:10px;margin:16px 0 26px;opacity:0;animation:fadeUp .5s ease forwards .2s;}
    .gold-div span{height:1px;}.gold-div span:first-child{width:36px;background:linear-gradient(to right,var(--deep-rose),var(--gold));}.gold-div span:last-child{flex:1;background:linear-gradient(to right,rgba(201,169,110,.18),transparent);}.gold-div i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}
    /* KPIs */
    .mini-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:22px;}
    .stat-card{background:var(--white);border-radius:16px;padding:20px 18px;border:1px solid var(--border);position:relative;overflow:hidden;transition:transform .22s,box-shadow .22s;opacity:0;animation:fadeUp .5s ease forwards;}
    .stat-card::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;background:linear-gradient(180deg,var(--deep-rose),var(--gold));}
    .stat-card:hover{transform:translateY(-4px);box-shadow:0 14px 30px rgba(196,116,138,.12);}
    .stat-ico{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px;}
    .stat-val{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:400;color:var(--dark);line-height:1;margin-bottom:4px;}
    .stat-lbl{font-size:9.5px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);}
    /* Card */
    .card{background:var(--white);border-radius:16px;border:1px solid var(--border);overflow:hidden;opacity:0;animation:fadeUp .5s ease forwards .28s;}
    .card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
    .card-head{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.45);}
    .card-head h3{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:400;color:var(--dark);}
    .card-head h3 em{color:var(--deep-rose);font-style:italic;}
    /* Search & filter */
    .search-wrap{position:relative;display:inline-flex;align-items:center;}
    .search-wrap input{background:var(--white);border:1px solid var(--border);padding:9px 14px 9px 36px;font-family:'Raleway',sans-serif;font-size:12px;font-weight:300;color:var(--dark);outline:none;width:210px;transition:border-color .25s,width .3s;}
    .search-wrap input:focus{border-color:var(--gold);width:250px;}
    .search-wrap::before{content:'🔍';position:absolute;left:11px;font-size:12px;pointer-events:none;opacity:.45;}
    .filter-select{background:var(--white);border:1px solid var(--border);padding:9px 14px;font-family:'Raleway',sans-serif;font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);outline:none;cursor:pointer;transition:border-color .2s;}
    .filter-select:focus{border-color:var(--gold);}
    /* Table */
    .admin-table{width:100%;border-collapse:collapse;}
    .admin-table thead th{text-align:left;font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--muted);font-weight:500;padding:12px 20px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.5);}
    .admin-table tbody tr{border-bottom:1px solid rgba(196,116,138,.06);transition:background .18s;}
    .admin-table tbody tr:last-child{border-bottom:none;}
    .admin-table tbody tr:hover{background:rgba(242,196,206,.1);}
    .admin-table tbody td{padding:13px 20px;font-size:13px;color:var(--text);vertical-align:middle;}
    .td-ref{font-family:'Cormorant Garamond',serif;font-size:14px;color:var(--muted);}
    .pill{display:inline-block;padding:3px 11px;border-radius:20px;font-size:10px;font-weight:500;}
    .pill-green{background:#E8F5F0;color:#2E7D5F;}.pill-gold{background:var(--gold-pale);color:#8A6A30;}.pill-rose{background:rgba(242,196,206,.35);color:var(--deep-rose);}.pill-red{background:#FEF0F0;color:#C62828;}
    .order-link{color:var(--deep-rose);text-decoration:none;font-size:13px;transition:color .2s;}
    .order-link:hover{color:var(--gold);}
    /* Pagination */
    .pagination-wrap{padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
    .pagination-wrap small{font-size:10.5px;color:var(--muted);}
    /* Empty */
    .empty-state{padding:48px 24px;text-align:center;}
    .empty-state .empty-ico{font-size:38px;margin-bottom:14px;opacity:.45;}
    .empty-state p{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:var(--muted);}
    .empty-state small{font-size:10px;color:rgba(156,122,128,.6);letter-spacing:2px;text-transform:uppercase;display:block;margin-top:4px;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    .d1{animation-delay:.05s}.d2{animation-delay:.13s}.d3{animation-delay:.21s}
    ::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

<div class="admin-page">

    {{-- ── Bouton retour ── --}}
    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M9 2L4 7L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Tableau de bord
    </a>

    {{-- ── Header ── --}}
    <div class="page-header-row">
        <div>
            <p class="page-eyebrow">Finance</p>
            <h1 class="page-title">Suivi des <em>Paiements</em></h1>
        </div>
        <div style="display:flex;gap:10px;align-items:center;opacity:0;animation:fadeUp .5s ease forwards .3s">
            <div class="search-wrap">
                <input type="text" placeholder="Rechercher…" oninput="filterTable(this.value)">
            </div>
            <select class="filter-select" onchange="filterStatus(this.value)">
                <option value="">Tous</option>
                <option value="paid">Payé</option>
                <option value="pending">En attente</option>
                <option value="failed">Échoué</option>
            </select>
        </div>
    </div>

    <div class="gold-div"><span></span><i></i><i></i><i></i><span></span></div>

    {{-- ── Mini KPIs ── --}}
    <div class="mini-kpi-row">
        <div class="stat-card d1">
            <div class="stat-ico" style="background:linear-gradient(135deg,#E8F5F0,#C8E8DC)">💰</div>
            <div class="stat-val">{{ number_format($totalPaid ?? 0, 0, ',', ' ') }}</div>
            <div class="stat-lbl">Total encaissé (DZD)</div>
        </div>
        <div class="stat-card d2">
            <div class="stat-ico" style="background:linear-gradient(135deg,var(--gold-pale),#EEE0C0)">⏳</div>
            <div class="stat-val">{{ $pendingCount ?? 0 }}</div>
            <div class="stat-lbl">En attente</div>
        </div>
        <div class="stat-card d3">
            <div class="stat-ico" style="background:linear-gradient(135deg,#FEF0F0,#F5D5DA)">❌</div>
            <div class="stat-val">{{ $failedCount ?? 0 }}</div>
            <div class="stat-lbl">Échoués</div>
        </div>
    </div>

    {{-- ── Table ── --}}
    <div class="card">
        <div class="card-head">
            <h3>Historique des <em>Paiements</em></h3>
            <span style="font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted)">
                {{ $payments->total() }} transaction{{ $payments->total() > 1 ? 's' : '' }}
            </span>
        </div>
        @if($payments->count() > 0)
            <table class="admin-table" id="payTable">
                <thead>
                    <tr><th>Réf.</th><th>Commande</th><th>Cliente</th><th>Montant</th><th>Méthode</th><th>Date</th><th>Statut</th></tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    @php
                        $sm = ['paid'=>['pill-green','Payé'],'pending'=>['pill-gold','En attente'],'failed'=>['pill-red','Échoué']];
                        [$pc,$pl] = $sm[$payment->status] ?? ['pill-rose',ucfirst($payment->status)];
                        $mi = ['card'=>'💳','cash'=>'💵','mobile'=>'📱','virement'=>'🏦'];
                        $ico = $mi[strtolower($payment->method)] ?? '💳';
                    @endphp
                    <tr data-status="{{ $payment->status }}">
                        <td class="td-ref">#{{ str_pad($payment->id,4,'0',STR_PAD_LEFT) }}</td>
                        <td><a href="{{ route('admin.orders.show', $payment->order) }}" class="order-link">#{{ str_pad($payment->order->id,4,'0',STR_PAD_LEFT) }}</a></td>
                        <td style="font-weight:500;color:var(--dark)">{{ $payment->order->user->name ?? '—' }}</td>
                        <td>
                            <span style="font-family:'Cormorant Garamond',serif;font-size:16px;color:var(--dark)">{{ number_format($payment->amount,0,',',' ') }}</span>
                            <span style="font-size:10px;color:var(--muted);margin-left:3px">DZD</span>
                        </td>
                        <td><span style="display:flex;align-items:center;gap:6px;font-size:12.5px">{{ $ico }} {{ ucfirst($payment->method) }}</span></td>
                        <td style="font-size:12px;color:var(--muted)">{{ $payment->created_at->format('d M Y · H:i') }}</td>
                        <td><span class="pill {{ $pc }}">{{ $pl }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrap">
                <small>{{ $payments->firstItem() }}–{{ $payments->lastItem() }} sur {{ $payments->total() }} transactions</small>
                {{ $payments->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-ico">💳</div>
                <p>Aucun paiement enregistré</p>
                <small>Les transactions apparaîtront ici</small>
            </div>
        @endif
    </div>

</div>

<script>
    let cs='',ss='';
    function filterTable(q){cs=q.toLowerCase();apply();}
    function filterStatus(s){ss=s;apply();}
    function apply(){document.querySelectorAll('#payTable tbody tr').forEach(r=>{r.style.display=(r.innerText.toLowerCase().includes(cs)&&(!ss||r.dataset.status===ss))?'':'none';});}
</script>
@endsection
