{{-- resources/views/checkout.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
:root{
    --cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;
    --deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;
    --dark:#3A2028;--panel-bg:#FDF8F5;--border:rgba(201,169,110,0.18);
    --muted:rgba(58,32,40,0.42);--success:#6BAF92;
    --wave-blue:#1B7FE2;--wave-cyan:#00B4D8;
    --orange-main:#FF6600;--orange-dark:#CC4400;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Raleway',sans-serif;background:var(--cream);min-height:100vh;}
body>*{max-width:none!important;padding:0!important;margin:0!important;}
.container,.container-fluid,#app,main{max-width:none!important;padding:0!important;margin:0!important;width:100%!important;}

/* ─── PAGE ─── */
.pay-page{min-height:100vh;display:flex;flex-direction:column;background:var(--cream);}

/* ─── TOPBAR ─── */
.pay-topbar{background:var(--panel-bg);border-bottom:1px solid var(--border);height:62px;display:flex;align-items:center;justify-content:space-between;padding:0 48px;position:relative;}
.pay-topbar::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmer 3s linear infinite;}
@keyframes shimmer{from{background-position:200% 0}to{background-position:-200% 0}}

.tb-brand{display:flex;align-items:center;gap:11px;}
.tb-circle{width:38px;height:38px;border-radius:50%;border:1.5px solid var(--gold);display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:15px;color:var(--gold);background:linear-gradient(135deg,#fff,var(--cream));}
.tb-name{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:300;color:var(--dark);}
.tb-name em{color:var(--deep-rose);font-style:italic;}

.tb-back{display:flex;align-items:center;gap:7px;padding:7px 16px;border:1px solid rgba(201,169,110,.28);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .2s;}
.tb-back:hover{border-color:var(--gold);color:var(--gold);background:rgba(201,169,110,.06);}
.tb-back svg{transition:transform .2s;}.tb-back:hover svg{transform:translateX(-2px);}

.tb-secure{display:flex;align-items:center;gap:6px;font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);}
.tb-dot{width:7px;height:7px;border-radius:50%;background:var(--success);box-shadow:0 0 5px rgba(107,175,146,.5);}

/* ─── MAIN ─── */
.pay-main{flex:1;display:flex;align-items:flex-start;justify-content:center;padding:44px 24px 60px;}
.pay-wrap{width:100%;max-width:880px;display:flex;flex-direction:column;gap:22px;}

/* ─── HEADER CARD ─── */
.pay-header{background:linear-gradient(140deg,var(--dark) 0%,#5A2830 100%);border-radius:0;padding:36px 42px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;}
.pay-header::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmer 3s linear infinite;}
.pay-header::after{content:'';position:absolute;top:-80px;right:-60px;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(232,160,176,.14),transparent 70%);pointer-events:none;}
.pay-header-glow{position:absolute;bottom:-50px;left:30%;width:180px;height:180px;border-radius:50%;background:radial-gradient(circle,rgba(201,169,110,.1),transparent 70%);pointer-events:none;}

.ph-left p.eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold-light);margin-bottom:8px;}
.ph-left h1{font-family:'Cormorant Garamond',serif;font-size:30px;font-weight:300;color:#fff;line-height:1.1;margin-bottom:6px;}
.ph-left h1 em{font-style:italic;color:var(--rose);}
.ph-left p.sub{font-size:12px;color:rgba(255,255,255,.35);letter-spacing:.5px;}

.ph-total{text-align:center;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:20px 30px;flex-shrink:0;}
.ph-total p{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold-light);margin-bottom:8px;}
.ph-total .amount{font-family:'Cormorant Garamond',serif;font-size:40px;font-weight:300;color:#fff;line-height:1;}
.ph-total .currency{font-size:13px;color:var(--gold-light);letter-spacing:2px;margin-top:4px;}

/* ─── ORDER SUMMARY (collapsible) ─── */
.summary-card{background:var(--panel-bg);border:1px solid var(--border);overflow:hidden;}
.summary-card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
.summary-head{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;cursor:pointer;user-select:none;}
.summary-head h3{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:400;color:var(--dark);}
.summary-head h3 em{font-style:italic;color:var(--deep-rose);}
.summary-toggle{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);cursor:pointer;}
.summary-body{border-top:1px solid var(--border);display:none;}
.summary-body.open{display:block;}
.summary-item{display:flex;align-items:center;gap:12px;padding:12px 24px;border-bottom:1px solid rgba(201,169,110,.07);}
.summary-item:last-child{border-bottom:none;}
.summary-item-img{width:42px;height:42px;border:1px solid rgba(201,169,110,.2);object-fit:cover;flex-shrink:0;background:var(--cream);}
.summary-item-img-ph{width:42px;height:42px;border:1px dashed rgba(201,169,110,.3);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;background:rgba(201,169,110,.06);}
.summary-item-name{flex:1;font-size:13px;font-weight:500;color:var(--dark);}
.summary-item-qty{font-size:11px;color:var(--muted);margin-top:2px;}
.summary-item-price{font-family:'Cormorant Garamond',serif;font-size:17px;color:var(--dark);}
.summary-total{display:flex;justify-content:space-between;align-items:center;padding:14px 24px;background:rgba(201,169,110,.05);border-top:1px solid var(--border);}
.summary-total span{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);}
.summary-total strong{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:400;color:var(--dark);}

/* ─── METHODS GRID ─── */
.methods-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

.method-card{background:var(--panel-bg);border:1px solid var(--border);overflow:hidden;transition:transform .25s,box-shadow .25s;cursor:pointer;position:relative;}
.method-card:hover{transform:translateY(-4px);box-shadow:0 18px 42px rgba(58,32,40,.09);}

/* Wave top accent */
.wave-card{border-top:3px solid var(--wave-blue);}
.orange-card{border-top:3px solid var(--orange-main);}

/* Glow orb */
.method-card::after{content:'';position:absolute;bottom:-30px;right:-30px;width:120px;height:120px;border-radius:50%;pointer-events:none;}
.wave-card::after{background:radial-gradient(circle,rgba(27,127,226,.06),transparent 70%);}
.orange-card::after{background:radial-gradient(circle,rgba(255,102,0,.06),transparent 70%);}

.mc-header{padding:22px 24px 18px;display:flex;align-items:center;gap:14px;}
.mc-logo-wrap{width:56px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.mc-logo-wrap svg{width:100%;height:100%;object-fit:contain;}
.mc-info{}
.mc-name{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:400;color:var(--dark);line-height:1;margin-bottom:4px;}
.mc-tag{font-size:8.5px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;padding:3px 8px;border-radius:20px;}
.wave-card .mc-tag{background:rgba(27,127,226,.1);color:var(--wave-blue);}
.orange-card .mc-tag{background:rgba(255,102,0,.1);color:var(--orange-main);}

.mc-sep{height:1px;background:var(--border);margin:0 24px;}
.mc-body{padding:18px 24px 22px;}
.mc-label{font-size:9px;letter-spacing:2.5px;text-transform:uppercase;color:var(--muted);margin-bottom:8px;}
.mc-number{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;color:var(--dark);letter-spacing:3px;margin-bottom:8px;line-height:1;}
.mc-owner{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--muted);letter-spacing:.4px;}
.mc-owner::before{content:'';display:inline-block;width:20px;height:1px;background:var(--gold-light);}
.copy-btn{display:flex;align-items:center;gap:7px;margin-top:14px;background:transparent;border:1px solid var(--border);padding:7px 13px;color:var(--muted);font-family:'Raleway',sans-serif;font-size:10.5px;letter-spacing:.5px;cursor:pointer;transition:all .2s;}
.copy-btn:hover{border-color:var(--gold);color:var(--gold);background:rgba(201,169,110,.06);}

/* ─── CONFIRM CARD ─── */
.confirm-card{background:var(--panel-bg);border:1px solid var(--border);overflow:hidden;}
.confirm-card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
.confirm-body{padding:28px 32px;}

/* Steps */
.steps{display:flex;gap:0;margin-bottom:28px;}
.step{flex:1;display:flex;flex-direction:column;align-items:center;text-align:center;position:relative;}
.step:not(:last-child)::after{content:'';position:absolute;top:16px;left:calc(50% + 16px);right:calc(-50% + 16px);height:1px;background:var(--border);}
.step-num{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;font-size:12px;font-weight:600;display:flex;align-items:center;justify-content:center;margin-bottom:10px;flex-shrink:0;position:relative;z-index:1;}
.step-text{font-size:11px;color:var(--muted);line-height:1.5;letter-spacing:.3px;max-width:100px;}

/* Payment method selector */
.method-selector{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:22px;}
.method-option{display:flex;align-items:center;gap:10px;padding:12px 16px;border:1px solid var(--border);cursor:pointer;transition:all .2s;position:relative;}
.method-option input[type="radio"]{display:none;}
.method-option label{display:flex;align-items:center;gap:10px;cursor:pointer;width:100%;font-size:12px;font-weight:500;color:var(--dark);}
.method-option:has(input:checked){border-color:var(--gold);background:rgba(201,169,110,.07);}
.method-option:has(input:checked)::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));}
.method-radio-dot{width:16px;height:16px;border-radius:50%;border:1.5px solid rgba(201,169,110,.4);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:border-color .2s;}
.method-option:has(input:checked) .method-radio-dot{border-color:var(--gold);}
.method-radio-dot::after{content:'';width:8px;height:8px;border-radius:50%;background:var(--gold);display:none;}
.method-option:has(input:checked) .method-radio-dot::after{display:block;}
.method-mini-logo{height:20px;width:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.method-mini-logo svg{width:100%;height:100%;object-fit:contain;}

/* Submit button */
.btn-confirm{width:100%;padding:15px;background:linear-gradient(135deg,var(--deep-rose) 0%,var(--gold) 100%);border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:11px;font-weight:600;letter-spacing:3.5px;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:transform .22s,box-shadow .22s;box-shadow:0 6px 20px rgba(196,116,138,.28);}
.btn-confirm::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.22),transparent);transition:left .55s;}
.btn-confirm:hover::before{left:160%;}.btn-confirm:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(196,116,138,.36);}

/* Note */
.confirm-note{display:flex;align-items:flex-start;gap:10px;margin-top:16px;padding:14px 16px;background:rgba(201,169,110,.06);border:1px solid rgba(201,169,110,.14);}
.confirm-note span{font-size:16px;flex-shrink:0;margin-top:1px;}
.confirm-note p{font-size:11.5px;color:var(--muted);letter-spacing:.3px;line-height:1.6;}

/* ─── ANIMATIONS ─── */
.fu{opacity:0;transform:translateY(16px);animation:fadeUp .45s ease forwards;}
.d1{animation-delay:.05s}.d2{animation-delay:.12s}.d3{animation-delay:.20s}.d4{animation-delay:.28s}.d5{animation-delay:.36s}
@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

/* ─── RESPONSIVE ─── */
@media(max-width:700px){.pay-header{flex-direction:column;gap:22px;align-items:flex-start;}.ph-total{width:100%;}.methods-row{grid-template-columns:1fr;}.steps{flex-direction:column;gap:14px;align-items:flex-start;}.step{flex-direction:row;text-align:left;gap:12px;}.step:not(:last-child)::after{display:none;}.step-text{max-width:none;}.pay-topbar{padding:0 18px;}.pay-main{padding:28px 16px 48px;}.method-selector{grid-template-columns:1fr;}}
::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

<div class="pay-page">

    {{-- ── TOPBAR ── --}}
    <header class="pay-topbar fu d1">
        <div class="tb-brand">
            <div class="tb-circle">Lh</div>
            <span class="tb-name">Lady's <em>Home</em></span>
        </div>

        <a href="{{ route('cart.index') }}" class="tb-back">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M9 2L4 7L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Retour au panier
        </a>

        <div class="tb-secure">
            <div class="tb-dot"></div>
            Paiement sécurisé
        </div>
    </header>

    {{-- ── MAIN ── --}}
    <main class="pay-main">
        <div class="pay-wrap">

            {{-- Header card --}}
            <div class="pay-header fu d1">
                <div class="pay-header-glow"></div>
                <div class="ph-left">
                    <p class="eyebrow">Lady's Home · Caisse</p>
                    <h1>Paiement <em>Sécurisé</em></h1>
                    <p class="sub">Choisissez votre méthode de paiement mobile</p>
                </div>
                <div class="ph-total">
                    <p>Montant total</p>
                    <div class="amount">{{ number_format($total ?? 0, 0, ',', ' ') }}</div>
                    <div class="currency">DZD</div>
                </div>
            </div>

            {{-- Order summary --}}
            <div class="summary-card fu d2">
                <div class="summary-head" onclick="toggleSummary()">
                    <h3>Récapitulatif de la <em>Commande</em></h3>
                    <span class="summary-toggle" id="toggle-txt">Voir le détail ▾</span>
                </div>
                <div class="summary-body" id="summary-body">
                    @foreach($cartItems ?? [] as $item)
                    <div class="summary-item">
                        @if($item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" class="summary-item-img" alt="{{ $item->product->name }}">
                        @else
                            <div class="summary-item-img-ph">🧴</div>
                        @endif
                        <div style="flex:1">
                            <div class="summary-item-name">{{ $item->product->name }}</div>
                            <div class="summary-item-qty">Qté : {{ $item->quantity }}</div>
                        </div>
                        <div class="summary-item-price">{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} <span style="font-family:'Raleway',sans-serif;font-size:10px;color:var(--gold)">DZD</span></div>
                    </div>
                    @endforeach
                    <div class="summary-total">
                        <span>Total à payer</span>
                        <strong>{{ number_format($total ?? 0, 0, ',', ' ') }} <span style="font-family:'Raleway',sans-serif;font-size:11px;color:var(--gold);font-weight:400">DZD</span></strong>
                    </div>
                </div>
            </div>

            {{-- Payment method cards --}}
            <div class="methods-row">

                {{-- ── WAVE ── --}}
                <div class="method-card wave-card fu d3">
                    <div class="mc-header">
                        <div class="mc-logo-wrap">
                            {{-- Wave Logo SVG ─ couleurs officielles --}}
                            <svg viewBox="0 0 120 40" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="waveGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#1B7FE2"/>
                                        <stop offset="100%" stop-color="#00B4D8"/>
                                    </linearGradient>
                                </defs>
                                {{-- W stylisé --}}
                                <path d="M8 8 L16 28 L22 14 L28 28 L36 8" stroke="url(#waveGrad)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                {{-- Texte "wave" --}}
                                <text x="44" y="26" font-family="Arial, sans-serif" font-size="18" font-weight="700" fill="url(#waveGrad)">wave</text>
                                {{-- Underline wave décorative --}}
                                <path d="M44 31 Q68 28 88 31" stroke="url(#waveGrad)" stroke-width="1.5" fill="none" opacity="0.5"/>
                            </svg>
                        </div>
                        <div class="mc-info">
                            <div class="mc-name">Wave</div>
                            <span class="mc-tag">Disponible</span>
                        </div>
                    </div>
                    <div class="mc-sep"></div>
                    <div class="mc-body">
                        <div class="mc-label">Numéro de transfert</div>
                        <div class="mc-number" id="wave-num">{{ $waveNumber ?? '77 000 00 00' }}</div>
                        <div class="mc-owner">Lady's Home</div>
                        <button class="copy-btn" onclick="copyNum('wave-num', this)">
                            📋 Copier le numéro
                        </button>
                    </div>
                </div>

                {{-- ── ORANGE MONEY ── --}}
                <div class="method-card orange-card fu d4">
                    <div class="mc-header">
                        <div class="mc-logo-wrap">
                            {{-- Orange Money Logo SVG ─ couleurs officielles --}}
                            <svg viewBox="0 0 120 40" xmlns="http://www.w3.org/2000/svg">
                                {{-- Cercle orange signature --}}
                                <circle cx="20" cy="20" r="14" fill="#FF6600"/>
                                <circle cx="20" cy="20" r="9" fill="#FF8C00" opacity="0.6"/>
                                <circle cx="20" cy="20" r="5" fill="#FFFFFF" opacity="0.9"/>
                                {{-- Texte Orange --}}
                                <text x="40" y="16" font-family="Arial, sans-serif" font-size="11" font-weight="700" fill="#FF6600">Orange</text>
                                {{-- Texte Money --}}
                                <text x="40" y="30" font-family="Arial, sans-serif" font-size="11" font-weight="400" fill="#CC4400">Money</text>
                            </svg>
                        </div>
                        <div class="mc-info">
                            <div class="mc-name">Orange Money</div>
                            <span class="mc-tag">Disponible</span>
                        </div>
                    </div>
                    <div class="mc-sep"></div>
                    <div class="mc-body">
                        <div class="mc-label">Numéro de transfert</div>
                        <div class="mc-number" id="orange-num">{{ $orangeNumber ?? '78 000 00 00' }}</div>
                        <div class="mc-owner">Lady's Home</div>
                        <button class="copy-btn" onclick="copyNum('orange-num', this)">
                            📋 Copier le numéro
                        </button>
                    </div>
                </div>

            </div>{{-- /methods-row --}}

            {{-- Confirm card --}}
            <div class="confirm-card fu d5">
                <div class="confirm-body">

                    {{-- Steps --}}
                    <div class="steps">
                        <div class="step">
                            <div class="step-num">1</div>
                            <div class="step-text">Copiez le numéro de la méthode choisie</div>
                        </div>
                        <div class="step">
                            <div class="step-num">2</div>
                            <div class="step-text">Effectuez le transfert du montant exact</div>
                        </div>
                        <div class="step">
                            <div class="step-num">3</div>
                            <div class="step-text">Sélectionnez la méthode utilisée ci-dessous</div>
                        </div>
                        <div class="step">
                            <div class="step-num">4</div>
                            <div class="step-text">Confirmez votre paiement</div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        {{-- Method selector --}}
                        <p style="font-size:9px;letter-spacing:2.5px;text-transform:uppercase;color:var(--gold);margin-bottom:10px">Méthode utilisée</p>
                        <div class="method-selector" style="margin-bottom:20px">
                            <div class="method-option">
                                <input type="radio" name="payment_method" id="m-wave" value="wave" checked>
                                <label for="m-wave">
                                    <div class="method-radio-dot"></div>
                                    <div class="method-mini-logo">
                                        <svg viewBox="0 0 60 20" xmlns="http://www.w3.org/2000/svg">
                                            <defs><linearGradient id="wg2" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#1B7FE2"/><stop offset="100%" stop-color="#00B4D8"/></linearGradient></defs>
                                            <path d="M2 2 L8 14 L11 7 L14 14 L20 2" stroke="url(#wg2)" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            <text x="23" y="13" font-family="Arial" font-size="10" font-weight="700" fill="url(#wg2)">wave</text>
                                        </svg>
                                    </div>
                                    Wave
                                </label>
                            </div>
                            <div class="method-option">
                                <input type="radio" name="payment_method" id="m-orange" value="orange_money">
                                <label for="m-orange">
                                    <div class="method-radio-dot"></div>
                                    <div class="method-mini-logo">
                                        <svg viewBox="0 0 40 20" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="10" cy="10" r="7" fill="#FF6600"/>
                                            <circle cx="10" cy="10" r="4" fill="#FF8C00" opacity="0.6"/>
                                            <circle cx="10" cy="10" r="2" fill="#fff" opacity="0.9"/>
                                            <text x="20" y="14" font-family="Arial" font-size="9" font-weight="700" fill="#FF6600">OM</text>
                                        </svg>
                                    </div>
                                    Orange Money
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-confirm">
                            ✅ &nbsp; J'ai effectué le paiement
                        </button>
                    </form>

                    <div class="confirm-note">
                        <span>🔒</span>
                        <p>Après confirmation, votre commande sera vérifiée par notre équipe sous 24h. Vous recevrez une notification dès la validation.</p>
                    </div>

                </div>
            </div>

        </div>{{-- /pay-wrap --}}
    </main>

</div>{{-- /pay-page --}}

<script>
function copyNum(id, btn) {
    const num = document.getElementById(id).textContent.trim();
    navigator.clipboard.writeText(num).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '✅ Copié !';
        btn.style.color = '#6BAF92';
        btn.style.borderColor = '#6BAF92';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.color = '';
            btn.style.borderColor = '';
        }, 2200);
    });
}

function toggleSummary() {
    const body = document.getElementById('summary-body');
    const txt  = document.getElementById('toggle-txt');
    const open = body.classList.toggle('open');
    txt.textContent = open ? 'Masquer ▴' : 'Voir le détail ▾';
}

// Sync method cards highlight with radio selection
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', () => {
        document.querySelectorAll('.method-card').forEach(c => c.style.boxShadow = '');
        if (radio.value === 'wave') {
            document.querySelector('.wave-card').style.boxShadow = '0 0 0 2px #1B7FE2, 0 12px 30px rgba(27,127,226,.15)';
        } else {
            document.querySelector('.orange-card').style.boxShadow = '0 0 0 2px #FF6600, 0 12px 30px rgba(255,102,0,.15)';
        }
    });
});
document.querySelector('.wave-card').style.boxShadow = '0 0 0 2px #1B7FE2, 0 12px 30px rgba(27,127,226,.15)';
</script>

@endsection
