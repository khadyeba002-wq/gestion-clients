{{-- resources/views/admin/settings/index.blade.php --}}
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
    .gold-div{display:flex;align-items:center;gap:10px;margin:16px 0 26px;opacity:0;animation:fadeUp .5s ease forwards .2s;}
    .gold-div span{height:1px;}.gold-div span:first-child{width:36px;background:linear-gradient(to right,var(--deep-rose),var(--gold));}.gold-div span:last-child{flex:1;background:linear-gradient(to right,rgba(201,169,110,.18),transparent);}.gold-div i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}
    .settings-grid{display:grid;grid-template-columns:1fr 310px;gap:20px;align-items:start;}
    @media(max-width:900px){.settings-grid{grid-template-columns:1fr;}}
    .card{background:var(--white);border-radius:16px;border:1px solid var(--border);overflow:hidden;margin-bottom:20px;opacity:0;animation:fadeUp .5s ease forwards;}
    .card::before{content:'';display:block;height:2px;background:linear-gradient(to right,var(--deep-rose),var(--gold),transparent);}
    .card-head{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:rgba(248,240,237,.45);}
    .card-head h3{font-family:'Cormorant Garamond',serif;font-size:19px;font-weight:400;color:var(--dark);}
    .card-head h3 em{color:var(--deep-rose);font-style:italic;}
    .card-body{padding:24px;}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    .field{margin-bottom:18px;position:relative;}
    .field label{display:block;font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:8px;}
    .field input,.field select,.field textarea{width:100%;background:#fff;border:1px solid rgba(201,169,110,.22);border-radius:0;padding:12px 16px;color:var(--dark);font-family:'Raleway',sans-serif;font-size:13px;font-weight:300;letter-spacing:.4px;outline:none;transition:border-color .3s,box-shadow .3s;box-shadow:0 1px 4px rgba(196,116,138,.05);}
    .field input::placeholder,.field textarea::placeholder{color:rgba(58,32,40,.22);font-size:12px;}
    .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,169,110,.1),0 2px 8px rgba(196,116,138,.07);}
    .field-bar{display:block;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));width:0;transition:width .4s ease;margin-top:-1px;}
    .field:focus-within .field-bar{width:100%;}
    .field select{cursor:pointer;}
    .field textarea{resize:vertical;min-height:80px;}
    .btn-primary{display:inline-flex;align-items:center;gap:8px;padding:13px 28px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:10.5px;font-weight:500;letter-spacing:3px;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;box-shadow:0 6px 22px rgba(196,116,138,.25);}
    .btn-primary::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);transition:left .5s ease;}
    .btn-primary:hover::before{left:160%;}.btn-primary:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(196,116,138,.35);}
    .alert{padding:12px 18px;margin-bottom:20px;font-size:12px;letter-spacing:.3px;display:flex;align-items:center;gap:10px;}
    .alert-success{background:rgba(201,169,110,.1);border:1px solid rgba(201,169,110,.3);color:var(--dark);border-left:3px solid var(--gold);}
    .alert-error{background:#FEF0F0;border:1px solid rgba(196,116,138,.25);color:#C62828;border-left:3px solid var(--deep-rose);}
    .preview-item{display:flex;gap:10px;align-items:flex-start;}
    .preview-lbl{font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:2px;}
    .preview-val{font-size:13px;color:var(--text);}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    .d1{animation-delay:.08s}.d2{animation-delay:.16s}.d3{animation-delay:.24s}
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

    <p class="page-eyebrow">Configuration</p>
    <h1 class="page-title">Para<em>mètres</em></h1>

    <div class="gold-div"><span></span><i></i><i></i><i></i><span></span></div>

    @if(session('success'))
        <div class="alert alert-success"><span>✦</span> {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error"><span>✦</span> Veuillez corriger les erreurs ci-dessous.</div>
    @endif

    <div class="settings-grid">
        <div>
            {{-- Boutique --}}
            <div class="card d1">
                <div class="card-head"><h3>Infos de la <em>Boutique</em></h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Nom de la boutique</label>
                                <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name ?? "Lady's Home") }}" placeholder="Lady's Home"><span class="field-bar"></span>
                            </div>
                            <div class="field">
                                <label>Devise</label>
                                <select name="currency">
                                    @foreach(['DZD','EUR','USD','FCFA','MAD'] as $cur)
                                        <option value="{{ $cur }}" {{ ($setting->currency ?? 'DZD') === $cur ? 'selected' : '' }}>{{ $cur }}</option>
                                    @endforeach
                                </select>
                                <span class="field-bar"></span>
                            </div>
                        </div>
                        <div class="form-grid">
                            <div class="field">
                                <label>Email de contact</label>
                                <input type="email" name="email" value="{{ old('email', $setting->email ?? '') }}" placeholder="contact@ladyshome.com"><span class="field-bar"></span>
                            </div>
                            <div class="field">
                                <label>Téléphone</label>
                                <input type="text" name="phone" value="{{ old('phone', $setting->phone ?? '') }}" placeholder="+213 5XX XXX XXX"><span class="field-bar"></span>
                            </div>
                        </div>
                        <div class="field">
                            <label>Adresse</label>
                            <input type="text" name="address" value="{{ old('address', $setting->address ?? '') }}" placeholder="Alger, Algérie"><span class="field-bar"></span>
                        </div>
                        <div class="field">
                            <label>Slogan</label>
                            <input type="text" name="description" value="{{ old('description', $setting->description ?? '') }}" placeholder="Cosmétiques · Beauté · Confiance"><span class="field-bar"></span>
                        </div>
                        <button type="submit" class="btn-primary"><span>✦</span> Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
            {{-- Livraison --}}
            <div class="card d2">
                <div class="card-head"><h3>Options de <em>Livraison</em></h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Frais de livraison (DZD)</label>
                                <input type="number" name="shipping_fee" value="{{ old('shipping_fee', $setting->shipping_fee ?? 0) }}" placeholder="0" min="0"><span class="field-bar"></span>
                            </div>
                            <div class="field">
                                <label>Livraison gratuite dès (DZD)</label>
                                <input type="number" name="free_shipping_from" value="{{ old('free_shipping_from', $setting->free_shipping_from ?? '') }}" placeholder="5000" min="0"><span class="field-bar"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary"><span>✦</span> Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Aperçu ── --}}
        <div>
            <div class="card d3" style="margin-bottom:0">
                <div class="card-head"><h3>Aperçu <em>Boutique</em></h3></div>
                <div class="card-body" style="text-align:center;padding:32px 22px">
                    <div style="width:68px;height:68px;border-radius:50%;border:1.5px solid var(--gold);background:linear-gradient(135deg,var(--deep-rose),var(--gold));display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 0 24px rgba(196,116,138,.28);font-family:'Cormorant Garamond',serif;font-size:26px;font-style:italic;font-weight:600;color:#fff">Lh</div>
                    <p style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:300;color:var(--dark);letter-spacing:1px">{{ $setting->app_name ?? "Lady's Home" }}</p>
                    <p style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-top:4px">{{ $setting->description ?? 'Cosmétiques · Beauté' }}</p>
                    <div style="display:flex;align-items:center;gap:8px;margin:20px 0">
                        <span style="flex:1;height:1px;background:linear-gradient(to right,transparent,var(--gold))"></span>
                        <span style="width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block"></span>
                        <span style="flex:1;height:1px;background:linear-gradient(to left,transparent,var(--gold))"></span>
                    </div>
                    <div style="text-align:left;display:flex;flex-direction:column;gap:14px">
                        @foreach([['📧','Email',$setting->email??'—'],['📞','Téléphone',$setting->phone??'—'],['📍','Adresse',$setting->address??'—'],['💱','Devise',$setting->currency??'DZD']] as [$ico,$lbl,$val])
                        <div class="preview-item">
                            <span style="font-size:15px;margin-top:1px">{{ $ico }}</span>
                            <div><span class="preview-lbl">{{ $lbl }}</span><span class="preview-val">{{ $val }}</span></div>
                        </div>
                        @endforeach
                    </div>


                    <div class="form-grid">

    <div class="field">
        <label>Numéro Wave</label>
        <input type="text" name="wave_number"
            value="{{ old('wave_number', $setting->wave_number ?? '') }}"
            placeholder="77 123 45 67">
        <span class="field-bar"></span>
    </div>

    <div class="field">
        <label>Numéro Orange Money</label>
        <input type="text" name="orange_number"
            value="{{ old('orange_number', $setting->orange_number ?? '') }}"
            placeholder="78 123 45 67">
        <span class="field-bar"></span>
    </div>

</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
