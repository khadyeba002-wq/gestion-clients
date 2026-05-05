{{-- resources/views/admin/clients/index.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--gold-pale:#FAF3E8;--dark:#3A2028;--dark-2:#2A1419;--text:#4A2E34;--muted:#9C7A80;--white:#FFFAF8;--bg:#F8F0ED;--border:rgba(196,116,138,0.13);}
    .admin-page{padding:28px 34px;font-family:'Raleway',sans-serif;color:var(--text);}

    /* ── Back button ── */
    .btn-back{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;font-weight:400;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s ease;margin-bottom:20px;opacity:0;animation:fadeUp .5s ease forwards .02s;}
    .btn-back:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);transform:translateX(-2px);}
    .btn-back svg{transition:transform .22s;}
    .btn-back:hover svg{transform:translateX(-3px);}

    /* ── Header ── */
    .page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:400;margin-bottom:6px;opacity:0;animation:fadeUp .5s ease forwards .07s;}
    .page-title{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);line-height:1;letter-spacing:1px;opacity:0;animation:fadeUp .5s ease forwards .13s;}
    .page-title em{font-style:italic;color:var(--deep-rose);}
    .page-header-row{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;}

    /* ── Gold divider ── */
    .gold-div{display:flex;align-items:center;gap:10px;margin:16px 0 26px;opacity:0;animation:fadeUp .5s ease forwards .2s;}
    .gold-div span{height:1px;}.gold-div span:first-child{width:36px;background:linear-gradient(to right,var(--deep-rose),var(--gold));}.gold-div span:last-child{flex:1;background:linear-gradient(to right,rgba(201,169,110,.18),transparent);}.gold-div i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}

    /* ── Card ── */
    .card{background:var(--white);border-radius:16px;border:1px solid var(--border);overflow:hidden;opacity:0;animation:fadeUp .5s ease forwards .26s;}
    .card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
    .card-head{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.45);}
    .card-head h3{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:400;color:var(--dark);}
    .card-head h3 em{color:var(--deep-rose);font-style:italic;}

    /* ── Search ── */
    .search-wrap{position:relative;display:inline-flex;align-items:center;}
    .search-wrap input{background:var(--white);border:1px solid var(--border);padding:9px 14px 9px 36px;font-family:'Raleway',sans-serif;font-size:12px;font-weight:300;color:var(--dark);outline:none;width:220px;transition:border-color .25s,width .3s;}
    .search-wrap input:focus{border-color:var(--gold);width:260px;}
    .search-wrap::before{content:'🔍';position:absolute;left:11px;font-size:12px;pointer-events:none;opacity:.45;}

    /* ── Table ── */
    .admin-table{width:100%;border-collapse:collapse;}
    .admin-table thead th{text-align:left;font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--muted);font-weight:500;padding:12px 20px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.5);}
    .admin-table tbody tr{border-bottom:1px solid rgba(196,116,138,.06);transition:background .18s;}
    .admin-table tbody tr:last-child{border-bottom:none;}
    .admin-table tbody tr:hover{background:rgba(242,196,206,.1);}
    .admin-table tbody td{padding:13px 20px;font-size:13px;color:var(--text);vertical-align:middle;}

    /* ── Pills ── */
    .pill{display:inline-block;padding:3px 11px;border-radius:20px;font-size:10px;font-weight:500;}
    .pill-green{background:#E8F5F0;color:#2E7D5F;}.pill-rose{background:rgba(242,196,206,.35);color:var(--deep-rose);}

    /* ── Buttons ── */
    .btn-ghost{display:inline-flex;align-items:center;gap:6px;padding:7px 16px;background:transparent;border:1px solid rgba(201,169,110,.3);color:var(--gold);font-family:'Raleway',sans-serif;font-size:9.5px;font-weight:400;letter-spacing:2px;text-transform:uppercase;text-decoration:none;cursor:pointer;transition:all .2s;}
    .btn-ghost:hover{background:rgba(201,169,110,.08);border-color:var(--gold);}

    /* ── Avatar ── */
    .avatar{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,rgba(242,196,206,.4),rgba(201,169,110,.25));border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:15px;color:var(--deep-rose);flex-shrink:0;}

    /* ── Pagination ── */
    .pagination-wrap{padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
    .pagination-wrap small{font-size:10.5px;color:var(--muted);}

    /* ── Empty ── */
    .empty-state{padding:48px 24px;text-align:center;}
    .empty-state .empty-ico{font-size:38px;margin-bottom:14px;opacity:.45;}
    .empty-state p{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:var(--muted);}
    .empty-state small{font-size:10px;color:rgba(156,122,128,.6);letter-spacing:2px;text-transform:uppercase;display:block;margin-top:4px;}

    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
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
            <p class="page-eyebrow">Gestion</p>
            <h1 class="page-title">Mes <em>Clients</em></h1>
        </div>
        <div style="opacity:0;animation:fadeUp .5s ease forwards .3s">
            <div class="search-wrap">
                <input type="text" id="clientSearch" placeholder="Rechercher un client…"
                       oninput="filterClients(this.value)">
            </div>
        </div>
    </div>

    <div class="gold-div"><span></span><i></i><i></i><i></i><span></span></div>

    {{-- ── Table ── --}}
    <div class="card">
        <div class="card-head">
            <h3>Liste des <em>Clients</em></h3>
            <span style="font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted)">
                {{ $clients->total() }} client{{ $clients->total() > 1 ? 's' : '' }}
            </span>
        </div>

        @if($clients->count() > 0)
            <table class="admin-table" id="clientTable">
                <thead>
                    <tr>
                        <th>Réf.</th><th>Cliente</th><th>Email</th>
                        <th>Inscrite le</th><th>Commandes</th><th>Statut</th>
                        <th style="text-align:right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td style="font-family:'Cormorant Garamond',serif;font-size:14px;color:var(--muted)">
                            #{{ str_pad($client->id,4,'0',STR_PAD_LEFT) }}
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                <div class="avatar">{{ strtoupper(substr($client->name,0,1)) }}</div>
                                <span style="font-weight:500;color:var(--dark)">{{ $client->name }}</span>
                            </div>
                        </td>
                        <td style="color:var(--muted);font-size:12.5px">{{ $client->email }}</td>
                        <td style="font-size:12px;color:var(--muted)">{{ $client->created_at->format('d M Y') }}</td>
                        <td>
                            <span style="font-family:'Cormorant Garamond',serif;font-size:18px;color:var(--dark)">
                                {{ $client->orders_count ?? $client->orders->count() }}
                            </span>
                        </td>
                        <td>
                            @if($client->email_verified_at)
                                <span class="pill pill-green">Vérifié</span>
                            @else
                                <span class="pill pill-rose">En attente</span>
                            @endif
                        </td>
                        <td style="text-align:right">
                            <a href="{{ route('admin.clients.show', $client) }}" class="btn-ghost">Voir le profil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrap">
                <small>{{ $clients->firstItem() }}–{{ $clients->lastItem() }} sur {{ $clients->total() }} clients</small>
                {{ $clients->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-ico">👥</div>
                <p>Aucune cliente inscrite</p>
                <small>Les comptes apparaîtront ici</small>
            </div>
        @endif
    </div>

</div>

<script>
function filterClients(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#clientTable tbody tr').forEach(r => {
        r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
@endsection
