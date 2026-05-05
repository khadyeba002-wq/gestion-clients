<x-guest-layout>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Raleway:wght@200;300;400;500&display=swap" rel="stylesheet">

<style>
    :root {
        --cream:      #FDF5F0;
        --blush:      #F2C4CE;
        --rose:       #E8A0B0;
        --deep-rose:  #C4748A;
        --gold:       #C9A96E;
        --gold-light: #E8D5B0;
        --dark:       #3A2028;
        --panel-bg:   #FDFAF8;
        --input-bg:   #FFFCFA;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body, html {
        background: var(--cream) !important;
        font-family: 'Raleway', sans-serif;
        height: 100vh; overflow: hidden;
    }

    /* Reset Breeze wrappers */
    .min-h-screen, .flex.flex-col.sm\:justify-center, .flex.min-h-screen {
        display: block !important;
        min-height: unset !important;
        padding: 0 !important;
        background: transparent !important;
    }

    /* ── SPLIT ── */
    .login-split {
        display: flex;
        width: 100vw; height: 100vh;
        overflow: hidden;
        position: fixed; inset: 0; z-index: 100;
        background: var(--cream);
    }

    /* ── LEFT ── */
    .split-left {
        flex: 1 1 58%;
        position: relative; overflow: hidden;
    }
    .split-left img.bg-photo {
        width: 100%; height: 100%;
        object-fit: cover; object-position: center;
        display: block;
        filter: brightness(.92) saturate(1.06);
        transition: transform 11s ease;
    }
    .split-left:hover img.bg-photo { transform: scale(1.045); }
    .split-left::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(to right,
            rgba(253,245,240,0) 40%,
            rgba(253,248,245,.6) 80%,
            rgba(253,250,248,1) 100%);
        pointer-events: none;
    }

    /* Vignette top/bottom */
    .split-left::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(to bottom,
            rgba(30,15,20,.25) 0%,
            transparent 30%,
            transparent 70%,
            rgba(30,15,20,.18) 100%);
        pointer-events: none; z-index: 1;
    }

    .image-badge {
        position: absolute; bottom: 44px; left: 40px;
        z-index: 2;
        opacity: 0; animation: fadeUp 1s ease forwards .5s;
    }
    .image-badge::before {
        content: ''; display: block;
        width: 36px; height: 1px;
        background: var(--gold); margin-bottom: 12px;
    }
    .image-badge .badge-title {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic; font-size: 34px; font-weight: 300;
        color: #fff;
        text-shadow: 0 2px 24px rgba(30,10,16,.55);
        line-height: 1; letter-spacing: 1px;
    }
    .image-badge .badge-sub {
        font-size: 8.5px; font-weight: 300;
        letter-spacing: 5px; text-transform: uppercase;
        color: var(--gold-light); margin-top: 6px;
    }

    /* ── RIGHT PANEL ── */
    .split-right {
        flex: 0 0 420px;
        background: var(--panel-bg);
        display: flex; flex-direction: column;
        justify-content: center;
        padding: 60px 54px;
        position: relative; overflow-y: auto;
        box-shadow: -28px 0 70px rgba(196,116,138,.09);
    }

    /* Shimmer top bar */
    .split-right::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(to right,
            var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
        background-size: 200% 100%;
        animation: shimmerBar 3.5s linear infinite;
    }
    @keyframes shimmerBar {
        from { background-position: 200% 0; }
        to   { background-position: -200% 0; }
    }

    /* Ambient glow */
    .split-right::after {
        content: ''; position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 75% 45% at 85% 8%,  rgba(242,196,206,.15) 0%, transparent 58%),
            radial-gradient(ellipse 55% 35% at 15% 92%, rgba(201,169,110,.09) 0%, transparent 58%);
        pointer-events: none;
    }

    /* Corner ornaments */
    .orn-svg {
        position: absolute; width: 34px; height: 34px;
        opacity: .2; z-index: 1; pointer-events: none;
    }
    .orn-svg.tl { top: 16px; left: 16px; }
    .orn-svg.br { bottom: 16px; right: 16px; transform: rotate(180deg); }

    /* ── LOGO ── */
    .form-logo {
        display: flex; align-items: center; gap: 13px;
        margin-bottom: 36px;
        opacity: 0; animation: fadeUp .7s ease forwards .2s;
        position: relative; z-index: 1;
    }
    .logo-circle {
        width: 48px; height: 48px; border-radius: 50%;
        border: 1.5px solid var(--gold);
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #fff 0%, var(--cream) 100%);
        box-shadow: 0 4px 18px rgba(201,169,110,.22), inset 0 1px 0 rgba(255,255,255,.85);
        font-family: 'Cormorant Garamond', serif;
        font-style: italic; font-size: 18px;
        color: var(--gold); font-weight: 400; flex-shrink: 0;
    }
    .logo-text .lt {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 400; font-size: 20px; color: var(--dark);
        letter-spacing: .5px; display: block; line-height: 1;
    }
    .logo-text .lt em { font-style: italic; color: var(--deep-rose); }
    .logo-text .ls {
        font-size: 8px; letter-spacing: 4px; text-transform: uppercase;
        color: var(--gold); font-weight: 300; margin-top: 4px; display: block;
    }

    /* ── HEADER ── */
    .form-eyebrow {
        font-size: 9px; letter-spacing: 4px; text-transform: uppercase;
        color: var(--deep-rose); font-weight: 400; margin-bottom: 10px;
        opacity: 0; animation: fadeUp .6s ease forwards .35s;
        position: relative; z-index: 1;
    }
    .form-title {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 300; font-size: 42px; color: var(--dark);
        line-height: 1; margin-bottom: 7px;
        opacity: 0; animation: fadeUp .6s ease forwards .44s;
        position: relative; z-index: 1;
    }
    .form-title em { font-style: italic; color: var(--deep-rose); }
    .form-desc {
        font-size: 11px; font-weight: 300;
        color: rgba(58,32,40,.38); letter-spacing: .5px; margin-bottom: 30px;
        opacity: 0; animation: fadeUp .6s ease forwards .52s;
        position: relative; z-index: 1;
    }

    /* Gold divider */
    .gold-div {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 28px;
        opacity: 0; animation: fadeIn .6s ease forwards .58s;
        position: relative; z-index: 1;
    }
    .gold-div span { flex: 1; height: 1px; }
    .gold-div span:first-child { background: linear-gradient(to right, transparent, var(--gold)); }
    .gold-div span:last-child  { background: linear-gradient(to left,  transparent, var(--gold)); }
    .gold-div i { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); display: block; }

    /* ── FIELDS ── */
    .field {
        margin-bottom: 18px;
        position: relative; z-index: 1;
        opacity: 0; animation: fadeUp .6s ease forwards;
    }
    .field:nth-child(1) { animation-delay: .62s; }
    .field:nth-child(2) { animation-delay: .72s; }

    .field label {
        display: block; font-size: 9px; letter-spacing: 3px;
        text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 8px;
    }
    .field-wrap { position: relative; }
    .field input {
        width: 100%; background: var(--input-bg);
        border: 1px solid rgba(201,169,110,.2);
        border-bottom-color: rgba(201,169,110,.38);
        border-radius: 0; padding: 13px 44px 13px 16px;
        color: var(--dark); font-family: 'Raleway', sans-serif;
        font-size: 13px; font-weight: 300; letter-spacing: .4px;
        outline: none; transition: border-color .3s, box-shadow .3s;
        box-shadow: 0 1px 5px rgba(196,116,138,.04);
    }
    .field input::placeholder { color: rgba(58,32,40,.2); font-size: 12px; }
    .field input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,169,110,.1), 0 2px 9px rgba(196,116,138,.07);
    }

    /* Eye toggle */
    .eye-btn {
        position: absolute; right: 13px; top: 50%;
        transform: translateY(-50%);
        background: none; border: none; cursor: pointer; padding: 4px;
        color: rgba(58,32,40,.3); transition: color .25s;
    }
    .eye-btn:hover { color: var(--gold); }
    .eye-btn svg { width: 16px; height: 16px; display: block; }

    .field-bar {
        display: block; height: 2px;
        background: linear-gradient(to right, var(--rose), var(--gold));
        width: 0; transition: width .4s ease; margin-top: -1px;
    }
    .field:focus-within .field-bar { width: 100%; }

    .error-msg {
        font-size: 10px; color: var(--deep-rose);
        margin-top: 5px; letter-spacing: .3px;
    }

    /* ── OPTIONS ── */
    .opts {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 28px;
        position: relative; z-index: 1;
        opacity: 0; animation: fadeUp .6s ease forwards .82s;
    }
    .check-label { display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .check-label input[type="checkbox"] {
        appearance: none; -webkit-appearance: none;
        width: 14px; height: 14px;
        border: 1px solid rgba(201,169,110,.4); background: var(--input-bg);
        cursor: pointer; position: relative; flex-shrink: 0;
        transition: background .2s, border-color .2s;
    }
    .check-label input:checked { background: var(--gold); border-color: var(--gold); }
    .check-label input:checked::after {
        content: '✓'; position: absolute; top: -2px; left: 1px;
        font-size: 11px; color: #fff;
    }
    .check-label span { font-size: 11px; font-weight: 300; color: rgba(58,32,40,.45); }

    .forgot {
        font-size: 11px; font-weight: 400; color: var(--deep-rose);
        text-decoration: none; letter-spacing: .3px;
        position: relative; transition: color .2s;
    }
    .forgot::after {
        content: ''; position: absolute; bottom: -2px; left: 0;
        width: 0; height: 1px; background: var(--gold); transition: width .3s;
    }
    .forgot:hover { color: var(--gold); }
    .forgot:hover::after { width: 100%; }

    /* ── SUBMIT ── */
    .btn-submit {
        width: 100%; padding: 15px;
        background: linear-gradient(135deg, var(--deep-rose) 0%, var(--gold) 100%);
        border: none; color: #fff;
        font-family: 'Raleway', sans-serif;
        font-size: 11px; font-weight: 500;
        letter-spacing: 5px; text-transform: uppercase;
        cursor: pointer; position: relative; overflow: hidden;
        transition: transform .2s, box-shadow .3s;
        box-shadow: 0 8px 30px rgba(196,116,138,.28), 0 2px 10px rgba(201,169,110,.2);
        z-index: 1;
        opacity: 0; animation: fadeUp .6s ease forwards .92s;
    }
    .btn-submit::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.28), transparent);
        transition: left .55s ease;
    }
    .btn-submit:hover::before { left: 160%; }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 44px rgba(196,116,138,.36), 0 4px 18px rgba(201,169,110,.24);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ── STATUS ── */
    .status-banner {
        background: rgba(201,169,110,.1);
        border: 1px solid rgba(201,169,110,.28);
        color: var(--dark); font-size: 11px;
        padding: 10px 14px; letter-spacing: .3px;
        margin-bottom: 18px; position: relative; z-index: 1;
    }

    /* ── REGISTER LINK ── */
    .reg-row {
        margin-top: 24px; text-align: center;
        position: relative; z-index: 1;
        opacity: 0; animation: fadeIn .6s ease forwards 1.1s;
    }
    .reg-row p { font-size: 11px; font-weight: 300; color: rgba(58,32,40,.4); }
    .reg-row a { color: var(--deep-rose); font-weight: 500; text-decoration: none; transition: color .2s; }
    .reg-row a:hover { color: var(--gold); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn { to { opacity: 1; } }

    @media (max-width: 768px) {
        .split-left { display: none; }
        .split-right { flex: 1; padding: 50px 28px; }
        body, html { overflow: auto; }
        .login-split { position: relative; height: auto; min-height: 100vh; }
    }
</style>

<div class="login-split">

    <!-- LEFT: IMAGE -->
    <div class="split-left">
        <img class="bg-photo" src="{{ asset('image/login.png') }}" alt="Lady's Home">
        <div class="image-badge">
            <p class="badge-title">Lady's Home</p>
            <p class="badge-sub">Cosmétiques · Beauté · Confiance</p>
        </div>
    </div>

    <!-- RIGHT: FORM -->
    <div class="split-right">

        <svg class="orn-svg tl" viewBox="0 0 34 34" fill="none">
            <path d="M1 33L1 1L33 1" stroke="#C9A96E" stroke-width="1.2"/>
            <circle cx="1" cy="1" r="2" fill="#C9A96E"/>
        </svg>
        <svg class="orn-svg br" viewBox="0 0 34 34" fill="none">
            <path d="M1 33L1 1L33 1" stroke="#C4748A" stroke-width="1.2"/>
            <circle cx="1" cy="1" r="2" fill="#C4748A"/>
        </svg>

        <div class="form-logo">
            <div class="logo-circle">Lh</div>
            <div class="logo-text">
                <span class="lt">Lady's <em>Home</em></span>
                <span class="ls">Espace membre</span>
            </div>
        </div>

        @if (session('status'))
            <div class="status-banner">{{ session('status') }}</div>
        @endif

        <p class="form-eyebrow">Connexion</p>
        <h1 class="form-title">Bon<em>jour</em></h1>
        <p class="form-desc">Accédez à votre univers beauté</p>

        <div class="gold-div">
            <span></span><i></i><i></i><i></i><span></span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Adresse e-mail</label>
                <div class="field-wrap">
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="votre@email.com"
                           required autofocus autocomplete="username">
                </div>
                <span class="field-bar"></span>
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="password">Mot de passe</label>
                <div class="field-wrap">
                    <input id="password" type="password" name="password"
                           placeholder="••••••••"
                           required autocomplete="current-password">
                    <button type="button" class="eye-btn" onclick="togglePwd('password', this)" tabindex="-1" aria-label="Afficher le mot de passe">
                        <svg id="eye-icon-password" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                <span class="field-bar"></span>
                @error('password')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="opts">
                <label class="check-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Se souvenir de moi</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="reg-row">
            <p>Pas encore membre ? <a href="{{ route('register') }}">Créer un compte</a></p>
        </div>

    </div>
</div>

<script>
function togglePwd(id, btn) {
    const inp = document.getElementById(id);
    const open  = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    const closed = `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
    const svg = btn.querySelector('svg');
    if (inp.type === 'password') { inp.type = 'text'; svg.innerHTML = closed; }
    else                          { inp.type = 'password'; svg.innerHTML = open; }
}
</script>

</x-guest-layout>
