@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--dark:#3A2028;--panel-bg:#FDF8F5;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body,html{font-family:'Raleway',sans-serif;background:var(--cream);}
.page{padding:40px 44px;min-height:100vh;background:var(--cream);}
/* TOP */
.top-bar{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:10px;}
.page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.page-title{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:36px;color:var(--dark);line-height:1;}
.page-title em{font-style:italic;color:var(--deep-rose);}
.back-btn{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;text-decoration:none;font-size:10px;font-weight:500;letter-spacing:3px;text-transform:uppercase;transition:transform .2s,box-shadow .2s;box-shadow:0 6px 18px rgba(196,116,138,0.25);position:relative;overflow:hidden;}
.back-btn::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.25),transparent);transition:left .5s;}
.back-btn:hover::before{left:160%;}
.back-btn:hover{transform:translateY(-2px);}
/* DIVIDER */
.gold-divider{display:flex;align-items:center;gap:10px;margin:22px 0 30px;}
.gold-divider span{flex:1;height:1px;}
.gold-divider span:first-child{background:linear-gradient(to right,transparent,var(--gold));}
.gold-divider span:last-child{background:linear-gradient(to left,transparent,var(--gold));}
.gold-divider i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}
/* CARD */
.card{background:var(--panel-bg);border:1px solid rgba(201,169,110,0.15);box-shadow:0 12px 40px rgba(58,32,40,0.06);overflow:hidden;}
.card::before{content:'';display:block;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmerBar 3s linear infinite;}
@keyframes shimmerBar{from{background-position:200% 0;}to{background-position:-200% 0;}}
/* TABLE */
table{width:100%;border-collapse:collapse;}
thead tr{background:rgba(201,169,110,0.07);border-bottom:1px solid rgba(201,169,110,0.2);}
th{padding:14px 20px;font-size:8px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:var(--gold);text-align:left;}
td{padding:16px 20px;border-bottom:1px solid rgba(201,169,110,0.1);font-size:13px;color:var(--dark);font-weight:300;vertical-align:middle;}
tbody tr{transition:background .2s;}
tbody tr:hover{background:rgba(201,169,110,0.04);}
tbody tr:last-child td{border-bottom:none;}
/* PRODUCT CELL */
.product-cell{display:flex;align-items:center;gap:14px;}
.product-img{width:50px;height:50px;object-fit:cover;border:1px solid rgba(201,169,110,0.25);flex-shrink:0;background:var(--cream);}
.product-img-ph{width:50px;height:50px;border:1px dashed rgba(201,169,110,0.3);display:flex;align-items:center;justify-content:center;font-size:18px;background:rgba(201,169,110,0.05);flex-shrink:0;}
.product-name{font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:400;color:var(--dark);}
/* PRICE */
.price-cell{font-family:'Cormorant Garamond',serif;font-size:17px;color:var(--dark);}
.price-cell small{font-family:'Raleway',sans-serif;font-size:10px;color:var(--gold);letter-spacing:1px;margin-left:3px;}
/* QTY */
.qty-badge{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid rgba(201,169,110,0.3);background:rgba(201,169,110,0.07);font-size:13px;font-weight:500;color:var(--dark);}
/* DELETE */
.btn-delete{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border:1px solid rgba(196,116,138,0.28);background:rgba(196,116,138,0.06);color:var(--deep-rose);font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;transition:background .2s,transform .15s;border-radius:0;}
.btn-delete:hover{background:rgba(196,116,138,0.14);transform:translateY(-1px);}
/* TOTAL */
.total-section{padding:20px 24px;border-top:1px solid rgba(201,169,110,0.18);display:flex;justify-content:space-between;align-items:center;background:rgba(201,169,110,0.04);}
.total-label{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:600;}
.total-amount{font-family:'Cormorant Garamond',serif;font-size:28px;font-weight:300;color:var(--dark);}
.total-amount small{font-family:'Raleway',sans-serif;font-size:12px;color:var(--gold);letter-spacing:1.5px;margin-left:5px;}
/* CHECKOUT BTN */
.btn-checkout{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:3px;text-transform:uppercase;cursor:pointer;transition:transform .2s,box-shadow .2s;box-shadow:0 6px 20px rgba(196,116,138,0.26);position:relative;overflow:hidden;}
.btn-checkout::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.25),transparent);transition:left .55s;}
.btn-checkout:hover::before{left:160%;}
.btn-checkout:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(196,116,138,0.34);}
/* EMPTY */
.empty-state{text-align:center;padding:70px 20px;}
.empty-icon{font-size:42px;display:block;margin-bottom:16px;}
.empty-text{font-size:13px;color:rgba(58,32,40,0.4);letter-spacing:0.5px;}
.empty-sub{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-top:10px;display:block;}
.btn-shop{display:inline-flex;align-items:center;gap:8px;margin-top:22px;padding:12px 24px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;text-decoration:none;font-size:10px;font-weight:500;letter-spacing:3px;text-transform:uppercase;box-shadow:0 6px 18px rgba(196,116,138,0.24);transition:transform .2s;}
.btn-shop:hover{transform:translateY(-2px);}
@media(max-width:768px){.page{padding:24px 16px;}.top-bar{flex-direction:column;align-items:flex-start;gap:14px;}.total-section{flex-direction:column;align-items:flex-start;gap:14px;}th:nth-child(3),td:nth-child(3){display:none;}}
</style>

<div class="page">
    <div class="top-bar">
        <div>
            <p class="page-eyebrow">Espace Client</p>
            <h1 class="page-title">Mon <em>Panier</em></h1>
        </div>
        <a href="{{ route('client.dashboard') }}" class="back-btn">← Dashboard</a>
    </div>
    <div class="gold-divider"><span></span><i></i><i></i><i></i><span></span></div>

```
<div class="card">
    @if($cartItems->count() > 0)
    @php $total = 0; @endphp
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Qté</th>
                <th>Sous-total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $item)
        @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
        <tr>
            <td>
                <div class="product-cell">
                    @if($item->product->image)
                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="product-img">
                    @else
                        <div class="product-img-ph">🧴</div>
                    @endif
                    <span class="product-name">{{ $item->product->name }}</span>
                </div>
            </td>
            <td><span class="price-cell">{{ number_format($item->product->price,0,',',' ') }}<small>FCFA</small></span></td>
            <td><span class="qty-badge">{{ $item->quantity }}</span></td>
            <td><span class="price-cell">{{ number_format($subtotal,0,',',' ') }}<small>FCFA</small></span></td>
            <td>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">🗑 Retirer</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="total-section">
        <div>
            <p class="total-label">Total panier</p>
            <div class="total-amount">{{ number_format($total,0,',',' ') }}<small>FCFA</small></div>

<form action="{{ route('client.orders.store') }}" method="POST">
    @csrf
    <button type="submit">🛍️ Commander</button>
</form>



    @else
    <div class="empty-state">
        <span class="empty-icon">🛒</span>
        <p class="empty-text">Votre panier est vide</p>
        <span class="empty-sub">Découvrez nos produits</span>
        <a href="{{ route('products.index') }}" class="btn-shop">🧴 Voir les produits</a>
    </div>
    @endif
</div>
```

</div>
@endsection
