@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--dark:#3A2028;--panel-bg:#FDF8F5;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body,html{font-family:'Raleway',sans-serif;background:var(--cream);}
.page{padding:40px 44px;min-height:100vh;background:var(--cream);display:flex;flex-direction:column;align-items:center;}
/* TOP */
.page-header{width:100%;max-width:640px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:flex-end;}
.page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.page-title{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:36px;color:var(--dark);line-height:1;}
.page-title em{font-style:italic;color:var(--deep-rose);}
.back-btn{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));color:#fff;text-decoration:none;font-size:10px;font-weight:500;letter-spacing:3px;text-transform:uppercase;transition:transform .2s,box-shadow .2s;box-shadow:0 6px 18px rgba(196,116,138,0.25);position:relative;overflow:hidden;}
.back-btn::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.25),transparent);transition:left .5s;}
.back-btn:hover::before{left:160%;}
.back-btn:hover{transform:translateY(-2px);}
/* DIVIDER */
.gold-divider{display:flex;align-items:center;gap:10px;margin:22px 0 28px;width:100%;max-width:640px;}
.gold-divider span{flex:1;height:1px;}
.gold-divider span:first-child{background:linear-gradient(to right,transparent,var(--gold));}
.gold-divider span:last-child{background:linear-gradient(to left,transparent,var(--gold));}
.gold-divider i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}
/* AVATAR */
.avatar-wrap{width:100%;max-width:640px;display:flex;align-items:center;gap:18px;margin-bottom:28px;}
.avatar-circle{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--blush),var(--rose));display:flex;align-items:center;justify-content:center;font-family:'Cormorant Garamond',serif;font-size:28px;font-style:italic;color:#fff;box-shadow:0 6px 20px rgba(196,116,138,0.28);flex-shrink:0;}
.avatar-info p{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:400;color:var(--dark);}
.avatar-info small{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-top:3px;display:block;}
/* ALERT */
.alert-success{background:rgba(107,175,146,0.1);border:1px solid rgba(107,175,146,0.3);color:#4a8a6e;font-size:12px;padding:12px 18px;letter-spacing:0.3px;margin-bottom:20px;width:100%;max-width:640px;}
/* CARD */
.form-card{width:100%;max-width:640px;background:var(--panel-bg);border:1px solid rgba(201,169,110,0.15);box-shadow:0 12px 40px rgba(58,32,40,0.06);overflow:hidden;margin-bottom:22px;position:relative;}
.form-card::before{content:'';display:block;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmerBar 3s linear infinite;}
@keyframes shimmerBar{from{background-position:200% 0;}to{background-position:-200% 0;}}
.form-card::after{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 40% at 90% 5%,rgba(242,196,206,0.13) 0%,transparent 60%);pointer-events:none;z-index:0;}
.card-inner{padding:30px 36px 36px;position:relative;z-index:1;}
/* SECTION LABEL */
.section-label{font-size:8px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:10px;}
.section-label::after{content:'';flex:1;height:1px;background:linear-gradient(to right,rgba(201,169,110,0.3),transparent);}
/* FIELD */
.field{margin-bottom:18px;}
.field label{display:block;font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:7px;}
.field input{width:100%;background:#fff;border:1px solid rgba(201,169,110,0.22);border-bottom:1px solid rgba(201,169,110,0.4);border-radius:0;padding:12px 16px;color:var(--dark);font-family:'Raleway',sans-serif;font-size:13px;font-weight:300;outline:none;transition:border-color .3s,box-shadow .3s;box-shadow:0 1px 4px rgba(196,116,138,0.04);}
.field input::placeholder{color:rgba(58,32,40,0.22);font-size:12px;}
.field input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,169,110,0.1);}
.field-bar{display:block;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));width:0;transition:width .4s ease;margin-top:-1px;}
.field:focus-within .field-bar{width:100%;}
.error-msg{font-size:10px;color:var(--deep-rose);margin-top:5px;}
/* BUTTON */
.btn-submit{padding:13px 28px;background:linear-gradient(135deg,var(--deep-rose) 0%,var(--gold) 100%);border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:10px;font-weight:500;letter-spacing:4px;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;box-shadow:0 8px 24px rgba(196,116,138,0.26);}
.btn-submit::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.25),transparent);transition:left .55s;}
.btn-submit:hover::before{left:160%;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 14px 36px rgba(196,116,138,0.34);}
@media(max-width:768px){.page{padding:24px 16px;}.page-header{flex-direction:column;align-items:flex-start;gap:14px;}.card-inner{padding:22px 20px 26px;}}
</style>

<div class="page">
    <div class="page-header">
        <div>
            <p class="page-eyebrow">Espace Client</p>
            <h1 class="page-title">Mon <em>Profil</em></h1>
        </div>
        <a href="{{ route('client.dashboard') }}" class="back-btn">← Dashboard</a>
    </div>

```
<div class="gold-divider"><span></span><i></i><i></i><i></i><span></span></div>

<div class="avatar-wrap">
    <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
    <div class="avatar-info">
        <p>{{ auth()->user()->name }}</p>
        <small>Cliente · Lady's Home</small>
    </div>
</div>

@if(session('success'))
<div class="alert-success">✓ &nbsp;{{ session('success') }}</div>
@endif

{{-- INFOS --}}
<div class="form-card">
    <div class="card-inner">
        <p class="section-label">Informations personnelles</p>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PUT')
            <div class="field">
                <label for="name">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Votre nom" required>
                <span class="field-bar"></span>
                @error('name')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" value="{{ auth()->user()->email }}" placeholder="votre@email.com" required>
                <span class="field-bar"></span>
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-submit">Mettre à jour</button>
        </form>
    </div>
</div>

{{-- SÉCURITÉ --}}
<div class="form-card">
    <div class="card-inner">
        <p class="section-label">Sécurité</p>
        <form method="POST" action="{{ route('profile.password') }}">
            @csrf @method('PUT')
            <div class="field">
                <label for="current_password">Mot de passe actuel</label>
                <input id="current_password" type="password" name="current_password" placeholder="••••••••">
                <span class="field-bar"></span>
                @error('current_password')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label for="password">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" placeholder="••••••••">
                <span class="field-bar"></span>
                @error('password')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••">
                <span class="field-bar"></span>
            </div>
            <button type="submit" class="btn-submit">Changer le mot de passe</button>
        </form>
    </div>
</div>
```

</div>
@endsection
