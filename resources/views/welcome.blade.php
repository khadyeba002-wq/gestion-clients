<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lady's Home — Univers Féminin</title>
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
            --dark-2:     #1E0F14;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            width: 100vw; height: 100vh;
            overflow: hidden;
            background: var(--dark-2);
            font-family: 'Raleway', sans-serif;
            cursor: none;
        }

        /* ── CURSOR ── */
        #cursor {
            position: fixed; width: 8px; height: 8px;
            background: var(--gold); border-radius: 50%;
            pointer-events: none; z-index: 9999;
            transform: translate(-50%,-50%);
            transition: width .15s, height .15s;
            mix-blend-mode: screen;
        }
        #cursorRing {
            position: fixed; width: 32px; height: 32px;
            border: 1px solid rgba(201,169,110,.45);
            border-radius: 50%; pointer-events: none; z-index: 9998;
            transform: translate(-50%,-50%);
            transition: width .25s ease, height .25s ease, border-color .25s;
        }
        body:has(.btn:hover) #cursorRing {
            width: 60px; height: 60px;
            border-color: rgba(201,169,110,.75);
        }

        /* ── BACKGROUND ── */
        .bg {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 65% 55% at 28% 48%, rgba(196,116,138,.15) 0%, transparent 58%),
                radial-gradient(ellipse 45% 55% at 78% 75%, rgba(201,169,110,.09) 0%, transparent 55%),
                radial-gradient(ellipse 40% 40% at 72% 20%, rgba(232,160,176,.07) 0%, transparent 55%),
                linear-gradient(155deg, var(--dark-2) 0%, #160B0F 55%, #221219 100%);
            animation: bgBreath 9s ease-in-out infinite alternate;
        }
        @keyframes bgBreath { from { opacity: .88; } to { opacity: 1; } }

        /* Noise overlay */
        .noise {
            position: fixed; inset: 0; z-index: 1; pointer-events: none; opacity: .032;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* ── DECO LINES ── */
        .deco-v {
            position: fixed; width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(201,169,110,.18), transparent);
            animation: vpulse 7s ease-in-out infinite alternate;
        }
        .deco-v:nth-child(1) { left: 8%;  top: 8%;  height: 220px; animation-delay: 0s; }
        .deco-v:nth-child(2) { left: 92%; top: 22%; height: 170px; animation-delay: 2s; }
        .deco-v:nth-child(3) { left: 50%; top: 2%;  height: 100px; animation-delay: 1s; }
        @keyframes vpulse { from { opacity: .4; } to { opacity: 1; } }

        /* ── CORNER ORNAMENTS ── */
        .orn { position: fixed; width: 52px; height: 52px; opacity: .16; z-index: 5; pointer-events: none; }
        .orn.tl { top: 20px; left: 20px; }
        .orn.tr { top: 20px; right: 20px; transform: scaleX(-1); }
        .orn.bl { bottom: 20px; left: 20px; transform: scaleY(-1); }
        .orn.br { bottom: 20px; right: 20px; transform: scale(-1); }

        /* ── FALLING IMAGES ── */
        .falling {
            position: fixed; top: -200px;
            pointer-events: none; z-index: 2;
            border-radius: 50%; object-fit: cover; opacity: 0;
            animation: fallDown linear infinite;
        }
        @keyframes fallDown {
            0%   { transform: translateY(0)     rotate(0deg)   scale(.75); opacity: 0; }
            6%   { opacity: .5; }
            90%  { opacity: .4; }
            100% { transform: translateY(116vh) rotate(330deg) scale(1.08); opacity: 0; }
        }

        /* ── MAIN ── */
        .stage {
            position: relative; z-index: 10;
            height: 100vh; display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 0;
        }

        .eyebrow {
            font-size: 8.5px; font-weight: 300;
            letter-spacing: 7px; text-transform: uppercase;
            color: rgba(201,169,110,.75);
            opacity: 0; animation: riseUp .9s ease forwards .25s;
            margin-bottom: 34px;
        }

        /* ── LOGO ── */
        .logo-wrap {
            position: relative;
            width: 190px; height: 190px;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; animation: fadein .8s ease forwards .5s;
            margin-bottom: 36px;
        }
        .ring1 {
            position: absolute; inset: 0; border-radius: 50%;
            border: 1px solid transparent;
            border-top-color: var(--gold);
            border-right-color: rgba(201,169,110,.28);
            animation: spin 10s linear infinite;
        }
        .ring2 {
            position: absolute; inset: 13px; border-radius: 50%;
            border: 1px dashed rgba(196,116,138,.18);
            animation: spin 16s linear infinite reverse;
        }
        .ring3 {
            position: absolute; inset: 26px; border-radius: 50%;
            border: .5px solid rgba(242,196,206,.1);
            animation: spin 22s linear infinite;
        }
        .logo-glow {
            position: absolute; inset: -14px; border-radius: 50%;
            background: radial-gradient(circle, rgba(201,169,110,.16) 0%, transparent 68%);
            animation: glowPulse 4.5s ease-in-out infinite alternate;
        }
        @keyframes glowPulse {
            from { transform: scale(.92); opacity: .5; }
            to   { transform: scale(1.2);  opacity: 1; }
        }
        .logo-img {
            width: 132px; height: 132px;
            object-fit: contain; border-radius: 50%;
            border: 1px solid rgba(201,169,110,.22);
            padding: 10px;
            background: rgba(58,32,40,.32);
            backdrop-filter: blur(12px);
            position: relative; z-index: 2;
            animation: logoReveal 3s cubic-bezier(.22,1,.36,1) forwards .5s,
                       logoSpin   22s linear 3.5s infinite;
        }
        @keyframes logoReveal {
            0%   { transform: scale(.25) rotate(0deg);    opacity: 0; filter: blur(14px); }
            60%  { transform: scale(1.07) rotate(345deg); opacity: 1; filter: blur(0); }
            100% { transform: scale(1)   rotate(360deg);  opacity: 1; filter: blur(0); }
        }
        @keyframes logoSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* ── TITLE ── */
        .title {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 300;
            font-size: clamp(56px, 9vw, 106px);
            color: var(--cream);
            letter-spacing: 5px;
            line-height: 1; text-align: center;
            opacity: 0; animation: riseUp 1s ease forwards 1.2s;
            margin-bottom: 4px;
        }
        .title .tl { font-style: italic; color: var(--blush); }
        .title .ta { color: var(--gold); font-style: italic; }
        .title .th {
            display: block;
            font-family: 'Raleway', sans-serif;
            font-size: .3em; font-weight: 200;
            letter-spacing: 18px; text-transform: uppercase;
            font-style: normal; color: var(--gold);
            margin-top: 8px; opacity: .88;
        }

        .subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: clamp(13px, 1.8vw, 17px);
            color: rgba(242,196,206,.6);
            font-weight: 300; letter-spacing: 1.8px;
            opacity: 0; animation: riseUp 1s ease forwards 1.65s;
            margin-bottom: 46px;
        }

        /* ── DIVIDER ── */
        .divider {
            display: flex; align-items: center; gap: 13px;
            margin-bottom: 46px;
            opacity: 0; animation: fadein 1s ease forwards 2s;
        }
        .divider span {
            width: 52px; height: 1px;
            background: linear-gradient(to right, transparent, var(--gold));
        }
        .divider span:last-child { background: linear-gradient(to left, transparent, var(--gold)); }
        .divider i { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); display: block; }

        /* ── BUTTON ── */
        .btn-wrap { opacity: 0; animation: riseUp 1s ease forwards 2.2s; }

        .btn {
            position: relative;
            padding: 15px 62px;
            background: transparent;
            border: 1px solid rgba(201,169,110,.45);
            color: var(--gold-light);
            font-family: 'Raleway', sans-serif;
            font-weight: 300; font-size: 10.5px;
            letter-spacing: 7px; text-transform: uppercase;
            cursor: none; overflow: hidden;
            transition: color .4s, border-color .4s;
        }
        .btn::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--deep-rose), var(--gold));
            transform: translateX(-101%);
            transition: transform .55s cubic-bezier(.22,1,.36,1);
            z-index: -1;
        }
        .btn:hover::before { transform: translateX(0); }
        .btn:hover { color: #fff; border-color: var(--gold); }
        .btn::after {
            content: ''; position: absolute;
            bottom: 0; left: 50%;
            width: 0; height: 1px; background: var(--blush);
            transform: translateX(-50%); transition: width .4s;
        }
        .btn:hover::after { width: 65%; }

        /* ── BOTTOM DOTS ── */
        .dots {
            position: fixed; bottom: 26px; left: 50%;
            transform: translateX(-50%);
            display: flex; gap: 28px; z-index: 10;
            opacity: 0; animation: fadein 1s ease forwards 2.8s;
        }
        .dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: rgba(201,169,110,.22);
            transition: background .3s, transform .3s; cursor: none;
        }
        .dot.active { background: var(--gold); transform: scale(1.6); }

        /* ── KEYFRAMES ── */
        @keyframes riseUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadein { to { opacity: 1; } }
    </style>
</head>
<body>

<div id="cursor"></div>
<div id="cursorRing"></div>

<div class="bg"></div>
<div class="noise"></div>

<div class="deco-v"></div>
<div class="deco-v"></div>
<div class="deco-v"></div>

<!-- Corner ornaments -->
<svg class="orn tl" viewBox="0 0 52 52" fill="none"><path d="M1 51L1 1L51 1" stroke="#C9A96E" stroke-width="1"/><circle cx="1" cy="1" r="2" fill="#C9A96E"/></svg>
<svg class="orn tr" viewBox="0 0 52 52" fill="none"><path d="M1 51L1 1L51 1" stroke="#C9A96E" stroke-width="1"/><circle cx="1" cy="1" r="2" fill="#C9A96E"/></svg>
<svg class="orn bl" viewBox="0 0 52 52" fill="none"><path d="M1 51L1 1L51 1" stroke="#C4748A" stroke-width="1"/><circle cx="1" cy="1" r="2" fill="#C4748A"/></svg>
<svg class="orn br" viewBox="0 0 52 52" fill="none"><path d="M1 51L1 1L51 1" stroke="#C4748A" stroke-width="1"/><circle cx="1" cy="1" r="2" fill="#C4748A"/></svg>

<div class="stage">
    <p class="eyebrow">Collection Exclusive &nbsp;·&nbsp; Saison 2025</p>

    <div class="logo-wrap">
        <div class="ring1"></div>
        <div class="ring2"></div>
        <div class="ring3"></div>
        <div class="logo-glow"></div>
        <img src="{{ asset('image/logo.png') }}" class="logo-img" alt="Lady's Home">
    </div>

    <h1 class="title">
        <span class="tl">Lady</span><span class="ta">'</span>s
        <span class="th">Home</span>
    </h1>
    <p class="subtitle">Entrez dans l'univers de la femme</p>

    <div class="divider">
        <span></span><i></i><i></i><i></i><span></span>
    </div>

    <div class="btn-wrap">
        <button class="btn" id="enterBtn">Entrer</button>
    </div>
</div>

<div class="dots">
    <div class="dot active"></div>
    <div class="dot"></div>
    <div class="dot"></div>
</div>

<script>
    // Cursor
    const cur = document.getElementById('cursor');
    const ring = document.getElementById('cursorRing');
    document.addEventListener('mousemove', e => {
        cur.style.left  = e.clientX + 'px'; cur.style.top  = e.clientY + 'px';
        ring.style.left = e.clientX + 'px'; ring.style.top = e.clientY + 'px';
    });

    // Falling images
    const imgs  = ["p1.png","p2.png","p3.png","p4.png","p5.png","p6.png","p7.png",
                   "p8.png","p9.png","p10.png","p11.png","p12.png","p13.png","p14.png","p15.png"];
    const tints = [
        'sepia(.14) saturate(.88)',
        'sepia(.2) hue-rotate(10deg) saturate(.82)',
        'sepia(.1) saturate(1.02)',
    ];

    function spawnFall() {
        const el   = document.createElement('img');
        el.src     = '/image/' + imgs[Math.floor(Math.random() * imgs.length)];
        el.className = 'falling';
        const sz   = 48 + Math.random() * 58;
        el.style.cssText = `
            left: ${Math.random() * 97}vw;
            width: ${sz}px; height: ${sz}px;
            animation-duration: ${7.5 + Math.random() * 7}s;
            animation-delay: ${Math.random() * 1.2}s;
            filter: ${tints[Math.floor(Math.random() * tints.length)]} drop-shadow(0 4px 14px rgba(201,169,110,.28));
        `;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 18000);
    }

    let n = 0;
    const burst = setInterval(() => { spawnFall(); if (++n >= 9) clearInterval(burst); }, 320);
    setInterval(spawnFall, 800);

    // Navigation
    document.getElementById('enterBtn').addEventListener('click', () => {
        document.body.style.transition = 'opacity .5s ease';
        document.body.style.opacity = '0';
        setTimeout(() => window.location.href = '/login', 520);
    });
</script>
</body>
</html>
