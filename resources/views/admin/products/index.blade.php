{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--gold-pale:#FAF3E8;--dark:#3A2028;--text:#4A2E34;--muted:#9C7A80;--white:#FFFAF8;--panel-bg:#FDF8F5;--border:rgba(196,116,138,0.13);--success:#6BAF92;--warning:#E0A854;--danger:#C4748A;}
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    .page{padding:28px 40px;background:var(--cream);min-height:100vh;font-family:'Raleway',sans-serif;}

    /* ── Back button ── */
    .btn-back{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;font-weight:400;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s ease;margin-bottom:22px;opacity:0;animation:fadeUp .5s ease forwards .02s;}
    .btn-back:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);transform:translateX(-2px);}
    .btn-back svg{transition:transform .22s;}.btn-back:hover svg{transform:translateX(-3px);}

    /* ── Top bar ── */
    .top-bar{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:0;opacity:0;animation:fadeUp .5s ease forwards .08s;}
    .page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:400;margin-bottom:6px;}
    .page-title{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:34px;color:var(--dark);line-height:1;}
    .page-title em{font-style:italic;color:var(--deep-rose);}

    /* ── Primary button ── */
    .btn-add{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--deep-rose) 0%,var(--gold) 100%);color:#fff;padding:11px 22px;text-decoration:none;font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:3px;text-transform:uppercase;transition:transform .2s,box-shadow .3s;box-shadow:0 6px 20px rgba(196,116,138,0.25);position:relative;overflow:hidden;}
    .btn-add::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);transition:left .5s ease;}
    .btn-add:hover::before{left:160%;}.btn-add:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(196,116,138,.35);}

    /* ── Gold divider ── */
    .gold-divider{display:flex;align-items:center;gap:10px;margin:18px 0 26px;opacity:0;animation:fadeUp .5s ease forwards .16s;}
    .gold-divider span{flex:1;height:1px;}.gold-divider span:first-child{background:linear-gradient(to right,transparent,var(--gold));}.gold-divider span:last-child{background:linear-gradient(to left,transparent,var(--gold));}.gold-divider i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}

    /* ── Card ── */
    .card{background:var(--panel-bg);border:1px solid rgba(201,169,110,.15);box-shadow:0 12px 40px rgba(58,32,40,.06);overflow:hidden;opacity:0;animation:fadeUp .5s ease forwards .22s;}
    .card::before{content:'';display:block;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmerBar 3s linear infinite;}
    @keyframes shimmerBar{from{background-position:200% 0}to{background-position:-200% 0}}

    /* ── Table ── */
    table{width:100%;border-collapse:collapse;}
    thead tr{background:rgba(201,169,110,.07);border-bottom:1px solid rgba(201,169,110,.2);}
    th{padding:13px 18px;font-size:8px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:var(--gold);text-align:left;}
    td{padding:15px 18px;border-bottom:1px solid rgba(201,169,110,.1);font-size:13px;color:var(--dark);font-weight:300;vertical-align:middle;}
    tbody tr{transition:background .2s;}
    tbody tr:hover{background:rgba(201,169,110,.05);}
    tbody tr:last-child td{border-bottom:none;}

    /* ── Product cell ── */
    .product-cell{display:flex;align-items:center;gap:14px;}
    .product-img{width:50px;height:50px;object-fit:cover;border:1px solid rgba(201,169,110,.25);flex-shrink:0;background:var(--cream);}
    .product-img-placeholder{width:50px;height:50px;border:1px dashed rgba(201,169,110,.35);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;background:rgba(201,169,110,.06);}
    .product-name{font-weight:500;font-size:14px;color:var(--dark);letter-spacing:.3px;}
    .product-id{font-size:10px;color:rgba(58,32,40,.35);letter-spacing:1px;margin-top:2px;}

    /* ── Price ── */
    .price{font-family:'Cormorant Garamond',serif;font-size:17px;font-weight:400;color:var(--dark);}
    .price span{font-family:'Raleway',sans-serif;font-size:10px;color:var(--gold);margin-left:3px;letter-spacing:1px;}

    /* ── Stock badges ── */
    .badge{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;font-size:10px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;}
    .badge-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
    .badge-success{background:rgba(107,175,146,.12);color:var(--success);border:1px solid rgba(107,175,146,.3);}.badge-success .badge-dot{background:var(--success);}
    .badge-warning{background:rgba(224,168,84,.12);color:var(--warning);border:1px solid rgba(224,168,84,.3);}.badge-warning .badge-dot{background:var(--warning);}
    .badge-danger{background:rgba(196,116,138,.12);color:var(--danger);border:1px solid rgba(196,116,138,.3);}.badge-danger .badge-dot{background:var(--danger);}

    /* ── Actions ── */
    .actions{display:flex;align-items:center;gap:8px;}
    .btn-action{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;text-decoration:none;border:none;cursor:pointer;transition:transform .15s;background:none;}
    .btn-edit{color:#4A7FC1;border:1px solid rgba(74,127,193,.3);background:rgba(74,127,193,.06);}.btn-edit:hover{background:rgba(74,127,193,.12);transform:translateY(-1px);}
    .btn-delete{color:var(--deep-rose);border:1px solid rgba(196,116,138,.3);background:rgba(196,116,138,.06);}.btn-delete:hover{background:rgba(196,116,138,.14);transform:translateY(-1px);}

    /* ── Empty ── */
    .empty-row td{text-align:center;padding:52px 20px;color:rgba(58,32,40,.35);font-size:13px;}
    .empty-icon{font-size:36px;display:block;margin-bottom:12px;}
    .empty-sub{font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-top:6px;display:block;}

    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    @media(max-width:768px){.page{padding:20px 16px;}.top-bar{flex-direction:column;align-items:flex-start;gap:16px;}th:nth-child(3),td:nth-child(3){display:none;}}
    ::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

<div class="page">

    {{-- ── Bouton retour ── --}}
    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M9 2L4 7L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Tableau de bord
    </a>

    {{-- ── Top bar ── --}}
    <div class="top-bar">
        <div>
            <p class="page-eyebrow">Administration</p>
            <h1 class="page-title">Gestion des <em>Produits</em></h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add">
            + Ajouter un produit
        </a>
    </div>

    <div class="gold-divider"><span></span><i></i><i></i><i></i><span></span></div>

    {{-- ── Table card ── --}}
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div class="product-cell">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-img">
                            @else
                                <div class="product-img-placeholder">🧴</div>
                            @endif
                            <div>
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-id">#{{ str_pad($product->id,4,'0',STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="price">{{ number_format($product->price,0,',',' ') }}<span>FCFA</span></div>
                    </td>
                    <td>
                        @if($product->stock <= 0)
                            <span class="badge badge-danger"><span class="badge-dot"></span> Rupture</span>
                        @elseif($product->stock <= 5)
                            <span class="badge badge-warning"><span class="badge-dot"></span> {{ $product->stock }} restants</span>
                        @else
                            <span class="badge badge-success"><span class="badge-dot"></span> {{ $product->stock }} en stock</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-action btn-edit">✏️ Modifier</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete"
                                        onclick="return confirm('Supprimer ce produit ?')">🗑 Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="4">
                        <span class="empty-icon">🧴</span>
                        Aucun produit pour le moment
                        <span class="empty-sub">Commencez par en ajouter un</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
