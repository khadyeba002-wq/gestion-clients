<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lady's Home — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,500&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream:       #FDF5F0;
            --blush:       #F2C4CE;
            --rose:        #E8A0B0;
            --deep-rose:   #C4748A;
            --gold:        #C9A96E;
            --gold-light:  #E8D5B0;
            --gold-pale:   #FAF3E8;
            --dark:        #3A2028;
            --dark-2:      #2A1419;
            --text:        #4A2E34;
            --muted:       #9C7A80;
            --white:       #FFFAF8;
            --bg:          #F8F0ED;
            --border:      rgba(196,116,138,0.13);
            --sb-w:        260px;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Raleway', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ══════════════════════════════════
           INTRO SCREEN
        ══════════════════════════════════ */
        #intro {
            position: fixed; inset: 0;
            background: var(--dark-2);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            z-index: 9999; gap: 30px;
        }

        /* Shimmer top bar (same as login) */
        #intro::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
            background-size: 200% 100%;
            animation: shimmerBar 3s linear infinite;
        }
        @keyframes shimmerBar {
            from { background-position: 200% 0; }
            to   { background-position: -200% 0; }
        }

        .intro-ring {
            position: relative;
            width: 450px; height: 450px;
        }
        .intro-ring svg {
            position: absolute; inset: 0;
            animation: spinRing 3.5s linear infinite;
        }
        @keyframes spinRing { to { transform: rotate(360deg); } }

        .intro-img-wrap {
            position: absolute; inset: 16px;
            border-radius: 50%; overflow: hidden;
            background: linear-gradient(135deg, var(--deep-rose), var(--gold));
            display: flex; align-items: center; justify-content: center;
            animation: pulseLogo 2.2s ease-in-out infinite alternate;
        }
        .intro-img-wrap img { width:100%; height:100%; object-fit:cover; }
        .intro-monogram {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px; font-style: italic; font-weight: 600; color: #fff;
        }
        @keyframes pulseLogo {
            from { box-shadow: 0 0 18px rgba(196,116,138,0.3); }
            to   { box-shadow: 0 0 52px rgba(196,116,138,0.65); }
        }

        .intro-text { text-align: center; }
        .intro-text h1 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 300; font-size: 36px;
            color: #fff; letter-spacing: 5px;
        }
        .intro-text h1 em { color: var(--blush); font-style: italic; }
        .intro-text p {
            font-size: 9px; letter-spacing: 5px;
            text-transform: uppercase; color: var(--gold); margin-top: 8px;
        }

        /* Gold divider — same as login form */
        .intro-divider {
            display: flex; align-items: center; gap: 10px;
        }
        .intro-divider span {
            width: 48px; height: 1px;
        }
        .intro-divider span:first-child { background: linear-gradient(to right, transparent, var(--gold)); }
        .intro-divider span:last-child  { background: linear-gradient(to left,  transparent, var(--gold)); }
        .intro-divider i { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); display:inline-block; }

        .intro-loader {
            width: 160px; height: 1px;
            background: rgba(255,255,255,0.07);
            border-radius: 2px; overflow: hidden;
        }
        .intro-loader-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--deep-rose), var(--gold));
            animation: load 2.8s cubic-bezier(.4,0,.2,1) forwards;
        }
        @keyframes load { from{width:0} to{width:100%} }

        /* ══════════════════════════════════
           LAYOUT
        ══════════════════════════════════ */
        #dashboard { display: none; }
        .layout { display: flex; min-height: 100vh; }

        /* ══════════════════════════════════
           SIDEBAR — dark like login bg
        ══════════════════════════════════ */
        .sidebar {
            width: var(--sb-w);
            background: var(--dark-2);
            position: fixed; top:0; left:0;
            height: 100vh;
            display: flex; flex-direction: column;
            overflow: hidden; z-index: 200;
        }

        /* Same shimmer top line as login */
        .sidebar::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
            background-size: 200% 100%;
            animation: shimmerBar 3s linear infinite;
        }

        /* Radial glow orbs */
        .sidebar-glow-1 {
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px; border-radius: 50%;
            background: radial-gradient(circle, rgba(196,116,138,0.1), transparent 70%);
            pointer-events: none;
        }
        .sidebar-glow-2 {
            position: absolute;
            bottom: -60px; left: -40px;
            width: 180px; height: 180px; border-radius: 50%;
            background: radial-gradient(circle, rgba(201,169,110,0.08), transparent 70%);
            pointer-events: none;
        }

        /* ── Sidebar Header ── */
        .sb-head {
            padding: 28px 22px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            position: relative; z-index: 1;
        }

        .sb-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }

        .sb-logo-circle {
            width: 46px; height: 46px; border-radius: 50%;
            border: 1.5px solid var(--gold);
            background: linear-gradient(135deg, var(--deep-rose), var(--gold));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 0 18px rgba(196,116,138,0.28);
        }
        .sb-logo-circle span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; font-style: italic; font-weight: 600; color: #fff;
        }

        .sb-name .lt {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 400; font-size: 19px; color: #fff; letter-spacing: 1px;
            display: block; line-height: 1;
        }
        .sb-name .lt em { color: var(--blush); font-style: italic; }
        .sb-name .ls {
            font-size: 8px; letter-spacing: 4px;
            text-transform: uppercase; color: var(--gold);
            font-weight: 300; margin-top: 3px; display: block;
        }

        /* Admin user badge */
        .sb-user {
            display: flex; align-items: center; gap: 10px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px; padding: 10px 12px;
        }
        .sb-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(242,196,206,0.3), rgba(201,169,110,0.2));
            border: 1px solid rgba(201,169,110,0.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; flex-shrink: 0;
        }
        .sb-user-info p { font-size: 12.5px; font-weight: 500; color: #fff; }
        .sb-user-info small { font-size: 9px; color: var(--muted); letter-spacing: 1px; text-transform: uppercase; }
        .sb-online {
            margin-left: auto; width: 8px; height: 8px; border-radius: 50%;
            background: #6ee7b7; box-shadow: 0 0 6px rgba(110,231,183,0.55);
            flex-shrink: 0;
        }

        /* ── Nav ── */
        .sb-nav {
            flex: 1; padding: 18px 12px;
            display: flex; flex-direction: column; gap: 2px;
            overflow-y: auto; position: relative; z-index: 1;
        }
        .sb-nav::-webkit-scrollbar { width: 0; }

        .sb-section {
            font-size: 9px; letter-spacing: 3px;
            text-transform: uppercase; color: rgba(255,255,255,0.16);
            padding: 16px 10px 5px; font-weight: 400;
        }

        .sb-link {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 13px; border-radius: 11px;
            text-decoration: none;
            color: rgba(255,255,255,0.45);
            font-size: 13px; font-weight: 300; letter-spacing: 0.3px;
            transition: all 0.22s ease;
            border: 1px solid transparent; cursor: pointer;
        }
        .sb-link:hover { background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.82); }
        .sb-link.active {
            background: linear-gradient(135deg, rgba(196,116,138,0.18), rgba(201,169,110,0.10));
            border-color: rgba(196,116,138,0.22);
            color: var(--blush);
        }

        .sb-icon {
            width: 33px; height: 33px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            background: rgba(255,255,255,0.05);
            flex-shrink: 0; transition: background 0.22s;
        }
        .sb-link.active .sb-icon {
            background: linear-gradient(135deg, var(--deep-rose), var(--gold));
        }

        .sb-badge {
            margin-left: auto;
            background: var(--deep-rose); color: #fff;
            font-size: 10px; padding: 2px 7px;
            border-radius: 20px; font-weight: 500;
        }

        /* ── Sidebar Footer ── */
        .sb-foot {
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,0.05);
            position: relative; z-index: 1;
        }
        .sb-logout-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 10px 13px; border-radius: 11px;
            border: none; background: none;
            color: rgba(255,255,255,0.3);
            font-family: 'Raleway', sans-serif;
            font-size: 12.5px; font-weight: 300; letter-spacing: 0.5px;
            cursor: pointer; transition: all 0.2s; text-align: left;
        }
        .sb-logout-btn:hover { background: rgba(196,116,138,0.1); color: var(--rose); }

        /* ══════════════════════════════════
           MAIN
        ══════════════════════════════════ */
        .main { margin-left: var(--sb-w); flex: 1; display: flex; flex-direction: column; }

        /* ── Topbar ── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            height: 62px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 34px;
            position: sticky; top: 0; z-index: 100;
        }
        /* Gold bottom accent on topbar */
        .topbar::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201,169,110,0.3), transparent);
        }

        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 400; color: var(--dark);
        }
        .topbar-title em { color: var(--deep-rose); font-style: italic; }

        .topbar-right { display: flex; align-items: center; gap: 18px; }
        .topbar-date {
            font-size: 10px; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--muted);
        }
        .topbar-notif {
            position: relative; width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(242,196,206,0.25), rgba(201,169,110,0.15));
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; cursor: pointer; transition: background 0.2s;
        }
        .topbar-notif:hover {
            background: linear-gradient(135deg, rgba(242,196,206,0.45), rgba(201,169,110,0.25));
        }
        .notif-dot {
            position: absolute; top: 8px; right: 8px;
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--deep-rose); border: 1.5px solid var(--white);
        }

        /* ── Content ── */
        .content { padding: 30px 32px; flex: 1; }

        /* ══ WELCOME BANNER ══ */
        .welcome {
            background: linear-gradient(140deg, var(--dark-2) 0%, #3A1520 100%);
            border-radius: 20px; padding: 30px 36px;
            margin-bottom: 24px;
            position: relative; overflow: hidden;
        }
        /* Top shimmer line — matches login button style */
        .welcome::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(to right, var(--rose), var(--gold), var(--blush), var(--gold), var(--rose));
            background-size: 200% 100%;
            animation: shimmerBar 3s linear infinite;
        }
        .welcome-glow-1 {
            position: absolute; top: -60px; right: -60px;
            width: 240px; height: 240px; border-radius: 50%;
            background: radial-gradient(circle, rgba(196,116,138,0.18), transparent 70%);
            pointer-events: none;
        }
        .welcome-glow-2 {
            position: absolute; bottom: -50px; right: 120px;
            width: 180px; height: 180px; border-radius: 50%;
            background: radial-gradient(circle, rgba(201,169,110,0.12), transparent 70%);
            pointer-events: none;
        }

        .welcome-inner { position: relative; z-index: 1; }

        .welcome h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px; font-weight: 300; color: #fff;
            letter-spacing: 1px; margin-bottom: 6px;
        }
        .welcome h2 em { color: var(--blush); font-style: italic; }

        /* Gold divider same as login */
        .welcome-divider {
            display: flex; align-items: center; gap: 10px; margin: 14px 0;
        }
        .welcome-divider span { height: 1px; }
        .welcome-divider span:first-child { width: 36px; background: linear-gradient(to right, var(--deep-rose), var(--gold)); }
        .welcome-divider span:last-child  { flex: 1; background: linear-gradient(to right, rgba(201,169,110,0.15), transparent); }
        .welcome-divider i { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); display:inline-block; }

        .welcome p { font-size: 12px; color: rgba(255,255,255,0.38); letter-spacing: 0.8px; }

        .welcome-kpis { display: flex; gap: 40px; margin-top: 22px; }
        .wkpi p {
            font-size: 9px; letter-spacing: 2px; text-transform: uppercase;
            color: rgba(255,255,255,0.28); margin-bottom: 4px;
        }
        .wkpi span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px; font-weight: 400; color: #fff;
        }
        .wkpi span sub { font-size: 13px; color: var(--blush); vertical-align: baseline; }

        /* ══ KPI CARDS ══ */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px; margin-bottom: 22px;
        }

        .kpi {
            background: var(--white);
            border-radius: 16px; padding: 20px 18px;
            border: 1px solid var(--border);
            position: relative; overflow: hidden;
            transition: transform 0.22s, box-shadow 0.22s;
        }
        /* Left accent bar — matches login field-bar */
        .kpi::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 3px; height: 100%;
            background: linear-gradient(180deg, var(--deep-rose), var(--gold));
        }
        .kpi:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(196,116,138,0.12);
        }

        .kpi-head {
            display: flex; align-items: flex-start;
            justify-content: space-between; margin-bottom: 12px;
        }
        .kpi-ico {
            width: 40px; height: 40px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .ico-rose  { background: linear-gradient(135deg, #FDEEF0, #F5D5DA); }
        .ico-gold  { background: linear-gradient(135deg, var(--gold-pale), #EEE0C0); }
        .ico-green { background: linear-gradient(135deg, #E8F5F0, #C8E8DC); }
        .ico-blue  { background: linear-gradient(135deg, #EEF2FD, #D0DEFB); }

        .kpi-trend {
            font-size: 10.5px; padding: 3px 8px;
            border-radius: 20px; font-weight: 500;
        }
        .up   { background: #E8F5F0; color: #2E7D5F; }
        .down { background: #FEF0F0; color: #C62828; }

        .kpi-val {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px; font-weight: 400;
            color: var(--dark); line-height: 1; margin-bottom: 4px;
        }
        .kpi-lbl {
            font-size: 9.5px; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--muted);
        }

        /* ══ BOTTOM GRID ══ */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 355px; gap: 18px;
        }

        .section-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
        }
        /* Top gold line on cards */
        .section-card::before {
            content: '';
            display: block; height: 2px;
            background: linear-gradient(to right, var(--deep-rose), var(--gold), transparent);
        }

        .sc-head {
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
        }
        .sc-head h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 19px; font-weight: 400; color: var(--dark);
        }
        .sc-head h3 em { color: var(--deep-rose); font-style: italic; }

        .sc-link {
            font-size: 9.5px; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--gold);
            text-decoration: none;
            border-bottom: 1px solid var(--gold-light);
            padding-bottom: 1px; transition: color 0.2s, border-color 0.2s;
        }
        .sc-link:hover { color: var(--deep-rose); border-color: var(--rose); }

        /* ── Mini Bar Chart ── */
        .minichart {
            display: flex; align-items: flex-end; gap: 6px;
            height: 72px; padding: 10px 22px 8px;
            border-bottom: 1px solid var(--border);
        }
        .mc-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; }
        .mc-bar {
            width: 100%; border-radius: 4px 4px 0 0;
            background: linear-gradient(180deg, var(--blush), var(--deep-rose));
            transition: opacity 0.18s;
        }
        .mc-bar:hover { opacity: 0.7; }
        .mc-bar.g { background: linear-gradient(180deg, var(--gold-light), var(--gold)); }
        .mc-lbl { font-size: 8.5px; letter-spacing: 1px; text-transform: uppercase; color: var(--muted); }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }
        thead th {
            text-align: left; font-size: 9px; letter-spacing: 2px;
            text-transform: uppercase; color: var(--muted);
            font-weight: 500; padding: 11px 22px;
            border-bottom: 1px solid var(--border);
            background: rgba(248,240,237,0.5);
        }
        tbody tr {
            border-bottom: 1px solid rgba(196,116,138,0.06);
            transition: background 0.18s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(242,196,206,0.1); }
        tbody td { padding: 12px 22px; font-size: 13px; color: var(--text); }

        /* Ref column */
        tbody td:first-child {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px; color: var(--muted);
        }

        .pill {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 10px; font-weight: 500;
        }
        .pill-green { background: #E8F5F0; color: #2E7D5F; }
        .pill-gold  { background: var(--gold-pale); color: #8A6A30; }
        .pill-rose  { background: rgba(242,196,206,0.35); color: var(--deep-rose); }
        .pill-red   { background: #FEF0F0; color: #C62828; }

        /* Empty state */
        .empty-state {
            padding: 40px 22px;
            text-align: center;
        }
        .empty-state .empty-icon {
            font-size: 36px; margin-bottom: 12px; opacity: 0.5;
        }
        .empty-state p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic; font-size: 16px;
            color: var(--muted); letter-spacing: 0.5px;
        }
        .empty-state small {
            font-size: 10px; color: rgba(156,122,128,0.6);
            letter-spacing: 1px; text-transform: uppercase;
            display: block; margin-top: 4px;
        }

        /* ── Top Products ── */
        .prod-item {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid rgba(196,116,138,0.07);
            transition: background 0.18s;
        }
        .prod-item:last-child { border-bottom: none; }
        .prod-item:hover { background: rgba(242,196,206,0.1); }

        .prod-rank {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; color: rgba(196,116,138,0.2);
            font-weight: 300; width: 20px; flex-shrink: 0; text-align: right;
        }
        .prod-dot {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, rgba(242,196,206,0.3), rgba(201,169,110,0.2));
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; flex-shrink: 0; overflow: hidden;
        }
        .prod-dot img { width: 100%; height: 100%; object-fit: cover; border-radius: 10px; }
        .prod-info { flex: 1; }
        .prod-info p { font-size: 13px; font-weight: 500; color: var(--dark); margin-bottom: 2px; }
        .prod-info small { font-size: 10.5px; color: var(--muted); }
        .prod-rev { text-align: right; }
        .prod-rev p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; color: var(--dark);
        }
        .prod-rev small { font-size: 9.5px; color: var(--muted); letter-spacing: 1px; }

        /* ── Animations ── */
        .fu { opacity:0; transform:translateY(18px); animation: fu 0.55s ease forwards; }
        @keyframes fu { to { opacity:1; transform:translateY(0); } }
        .d1{animation-delay:.05s} .d2{animation-delay:.12s} .d3{animation-delay:.20s}
        .d4{animation-delay:.28s} .d5{animation-delay:.36s} .d6{animation-delay:.44s}
        .d7{animation-delay:.52s}

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--blush); border-radius: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>
<body>

{{-- ══ INTRO ══ --}}
<div id="intro">
    <div class="intro-ring">
        <svg viewBox="0 0 136 136" width="136" height="136">
            <circle cx="68" cy="68" r="60"
                fill="none" stroke="url(#ig)" stroke-width="1.5"
                stroke-dasharray="6 8" stroke-linecap="round"/>
            <defs>
                <linearGradient id="ig" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#C4748A"/>
                    <stop offset="100%" stop-color="#C9A96E"/>
                </linearGradient>
            </defs>
        </svg>
        <div class="intro-img-wrap">
            <img src="{{ asset('image/admin.png') }}" alt="Logo"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
            <span class="intro-monogram" style="display:none">Lh</span>
        </div>
    </div>

    <div class="intro-text">
        <h1>Lady's <em>Home</em></h1>
        <p>Espace Administrateur</p>
    </div>

    <div class="intro-divider">
        <span></span><i></i><i></i><i></i><span></span>
    </div>

    <div class="intro-loader"><div class="intro-loader-bar"></div></div>
</div>

{{-- ══ DASHBOARD ══ --}}
<div id="dashboard">
<div class="layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
        <div class="sidebar-glow-1"></div>
        <div class="sidebar-glow-2"></div>

        <div class="sb-head">
            <div class="sb-brand">
                <div class="sb-logo-circle"><span>Lh</span></div>
                <div class="sb-name">
                    <span class="lt">Lady's <em>Home</em></span>
                    <span class="ls">Admin Panel</span>
                </div>
            </div>
            <div class="sb-user">
                <div class="sb-avatar">👤</div>
                <div class="sb-user-info">
                    <p>{{ auth()->user()->name ?? 'Administrateur' }}</p>
                    <small>Super Admin</small>
                </div>
                <div class="sb-online"></div>
            </div>
        </div>

        <nav class="sb-nav">
            <div class="sb-section">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="sb-link active" onclick="setActive(this)">
                <div class="sb-icon">📊</div>Tableau de bord
            </a>
            <a href="{{ route('admin.products.index') }}" class="sb-link">
                <div class="sb-icon">📦</div>Produits
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sb-link" >
                <div class="sb-icon">📑</div>Commandes
                @if(($pendingOrders ?? 0) > 0)
                    <span class="sb-badge">{{ $pendingOrders }}</span>
                @endif
            </a>





            <a href="{{ route('admin.clients.index') }}" class="sb-link" >
                <div class="sb-icon">👥</div>Clients
            </a>

            <div class="sb-section">Finance</div>
            <a href="{{ route('admin.payments.index') }}" class="sb-link" >
                <div class="sb-icon">💳</div>Paiements
            </a>
            <a href="{{ route('admin.stats') }}" class="sb-link">
                <div class="sb-icon">📈</div>Statistiques
            </a>

            <div class="sb-section">Système</div>
            <a href="{{ route('admin.settings.index') }}" class="sb-link">
                <div class="sb-icon">⚙️</div>Paramètres
            </a>
        </nav>

        <div class="sb-foot">
           <div class="sb-foot">

    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf

        <button type="submit" class="sb-logout-btn">
            <span class="logout-icon">↩</span>
            <span>Déconnexion</span>
        </button>
    </form>

</div>
        </div>
    </aside>

    {{-- ── MAIN ── --}}
    <div class="main">

        <header class="topbar">
            <div class="topbar-title">Tableau de <em>Bord</em></div>
            <div class="topbar-right">
                <span class="topbar-date" id="dateDisplay"></span>
                <div class="topbar-notif">🔔<div class="notif-dot"></div></div>
            </div>
        </header>

        <div class="content">

            {{-- ── Welcome ── --}}
            <div class="welcome fu d1">
                <div class="welcome-glow-1"></div>
                <div class="welcome-glow-2"></div>
                <div class="welcome-inner">
                    <h2>Bienvenue, <em>{{ auth()->user()->name ?? 'Administratrice' }}</em> 👋</h2>
                    <div class="welcome-divider">
                        <span></span><i></i><i></i><i></i><span></span>
                    </div>
                    <p>Voici un aperçu de votre activité du jour</p>
                    <div class="welcome-kpis">
                        <div class="wkpi">
                            <p>Chiffre du jour</p>
                            <span>{{ number_format($revenueToday ?? 0, 0, ',', ' ') }} <sub>FCFA</sub></span>
                        </div>
                        <div class="wkpi">
                            <p>Commandes</p>
                            <span>{{ $ordersToday ?? 0 }}</span>
                        </div>
                        <div class="wkpi">
                            <p>Nouveaux clients</p>
                            <span>{{ $newClientsToday ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── KPI Cards ── --}}
            <div class="kpi-row">
                <div class="kpi fu d2">
                    <div class="kpi-head">
                        <div class="kpi-ico ico-rose">💄</div>
                        <span class="kpi-trend {{ ($productsTrend ?? 0) >= 0 ? 'up' : 'down' }}">
                            {{ ($productsTrend ?? 0) >= 0 ? '↑' : '↓' }} {{ abs($productsTrend ?? 0) }} %
                        </span>
                    </div>
                    <div class="kpi-val">{{ $productsCount ?? 0 }}</div>
                    <div class="kpi-lbl">Produits en stock</div>
                </div>
                <div class="kpi fu d3">
                    <div class="kpi-head">
                        <div class="kpi-ico ico-gold">📦</div>
                        <span class="kpi-trend {{ ($ordersTrend ?? 0) >= 0 ? 'up' : 'down' }}">
                            {{ ($ordersTrend ?? 0) >= 0 ? '↑' : '↓' }} {{ abs($ordersTrend ?? 0) }} %
                        </span>
                    </div>
                    <div class="kpi-val">{{ number_format($ordersMonth ?? 0, 0, ',', ' ') }}</div>
                    <div class="kpi-lbl">Commandes ce mois</div>
                </div>
                <div class="kpi fu d4">
                    <div class="kpi-head">
                        <div class="kpi-ico ico-green">👥</div>
                        <span class="kpi-trend {{ ($clientsTrend ?? 0) >= 0 ? 'up' : 'down' }}">
                            {{ ($clientsTrend ?? 0) >= 0 ? '↑' : '↓' }} {{ abs($clientsTrend ?? 0) }} %
                        </span>
                    </div>
                    <div class="kpi-val">{{ number_format($clientsCount ?? 0, 0, ',', ' ') }}</div>
                    <div class="kpi-lbl">Clients inscrits</div>
                </div>
                <div class="kpi fu d5">
                    <div class="kpi-head">
                        <div class="kpi-ico ico-blue">💳</div>
                        <span class="kpi-trend {{ ($revenueTrend ?? 0) >= 0 ? 'up' : 'down' }}">
                            {{ ($revenueTrend ?? 0) >= 0 ? '↑' : '↓' }} {{ abs($revenueTrend ?? 0) }} %
                        </span>
                    </div>
                    <div class="kpi-val">{{ number_format(($revenueMonth ?? 0)/1000, 0) }} K</div>
                    <div class="kpi-lbl">Revenus (FCFA)</div>
                </div>
            </div>

            {{-- ── Bottom Grid ── --}}
            <div class="grid-2">

                {{-- Commandes --}}
                <div class="section-card fu d6">
                    <div class="sc-head">
                        <h3>Dernières <em>Commandes</em></h3>
                        <a href="{{ route('admin.orders.index') }}" class="sc-link">Voir tout</a>
                    </div>

                    {{-- Mini chart (7 jours) --}}
                    <div class="minichart">
                        @foreach($weeklyOrders ?? [40,60,80,50,70,95,30] as $h)
                            @php $max = max($weeklyOrders ?? [40,60,80,50,70,95,30]); @endphp
                            <div class="mc-col">
                                <div class="mc-bar {{ $loop->index === 2 || $loop->index === 5 ? 'g' : '' }}"
                                     style="height:{{ $max > 0 ? round(($h/$max)*100) : 0 }}%">
                                </div>
                                <span class="mc-lbl">{{ ['L','M','Me','J','V','S','D'][$loop->index] }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Table --}}
                    @if(isset($latestOrders) && $latestOrders->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>Réf.</th>
                                    <th>Cliente</th>
                                    <th>Produit</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestOrders as $order)
                                    <tr>
                                        <td>#LH-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $order->client->name ?? '—' }}</td>
                                        <td>{{ $order->items->first()?->product->name ?? '—' }}</td>
                                        <td>{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                                        <td>
                                            @php
                                                $map = [
                                                    'delivered' => ['pill-green','Livré'],
                                                    'processing'=> ['pill-gold', 'En cours'],
                                                    'pending'   => ['pill-rose', 'Préparation'],
                                                    'cancelled' => ['pill-red',  'Annulé'],
                                                ];
                                                [$cls,$label] = $map[$order->status] ?? ['pill-rose',$order->status];
                                            @endphp
                                            <span class="pill {{ $cls }}">{{ $label }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📑</div>
                            <p>Aucune commande pour le moment</p>
                            <small>Les commandes apparaîtront ici</small>
                        </div>
                    @endif
                </div>

                {{-- Top Produits --}}
                <div class="section-card fu d7">
                    <div class="sc-head">
                        <h3>Top <em>Produits</em></h3>
                        <a href="{{ route('admin.products.index') }}" class="sc-link">Voir tout</a>
                    </div>

                    @if(isset($topProducts) && $topProducts->count() > 0)
                        @foreach($topProducts as $i => $product)
                            <div class="prod-item">
                                <span class="prod-rank">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="prod-dot">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        💄
                                    @endif
                                </div>
                                <div class="prod-info">
                                    <p>{{ $product->name }}</p>
                                    <small>{{ $product->sales_count ?? 0 }} ventes</small>
                                </div>
                                <div class="prod-rev">
                                    <p>{{ number_format($product->total_revenue ?? 0, 0, ',', ' ') }}</p>
                                    <small>FCFA</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📦</div>
                            <p>Aucun produit vendu</p>
                            <small>Ajoutez des produits pour commencer</small>
                        </div>
                    @endif
                </div>

            </div>{{-- /grid-2 --}}
        </div>{{-- /content --}}
    </div>{{-- /main --}}

</div>{{-- /layout --}}
</div>{{-- /dashboard --}}

<script>
    // ── Intro → Dashboard ──
    setTimeout(() => {
        const intro = document.getElementById('intro');
        intro.style.transition = 'opacity .7s ease';
        intro.style.opacity = '0';
        setTimeout(() => {
            intro.style.display = 'none';
            document.getElementById('dashboard').style.display = 'block';
        }, 720);
    }, 3000);

    // ── Date ──
    document.getElementById('dateDisplay').textContent =
        new Date().toLocaleDateString('fr-FR', {
            weekday:'long', day:'numeric', month:'long', year:'numeric'
        });

    // ── Sidebar active ──
    function setActive(el) {
        if(event) event.preventDefault();
        document.querySelectorAll('.sb-link').forEach(l => l.classList.remove('active'));
        el.classList.add('active');
    }
</script>

</body>
</html>
