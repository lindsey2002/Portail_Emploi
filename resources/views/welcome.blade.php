<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Librisky Jobs') }} — Portail Emploi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800|instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root {
            --ink:      #0D0D0D;
            --ink-2:    #3A3A3A;
            --ink-3:    #7A7A7A;
            --surface:  #F7F5F0;
            --card:     #FFFFFF;
            --accent:   #FF4D00;
            --accent-2: #FFB800;
            --blue:     #1A56DB;
            --blue-lt:  #EBF2FF;
            --green:    #0A7A3E;
            --green-lt: #E6F7EE;
            --amber:    #B45309;
            --amber-lt: #FEF3C7;
            --border:   #E5E2DA;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
        }
        h1, h2, h3, h4, .logo-text { font-family: 'Syne', sans-serif; }

        /* ── NAV ── */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(247,245,240,.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-dot { width: 32px; height: 32px; background: var(--accent); border-radius: 8px; display: grid; place-items: center; }
        .logo-dot svg { width: 18px; height: 18px; fill: #fff; }
        .logo-text { font-size: 20px; font-weight: 700; color: var(--ink); letter-spacing: -.03em; }
        .logo-text span { color: var(--accent); }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-link {
            font-size: 13px; font-weight: 500; color: var(--ink-2);
            text-decoration: none; padding: 8px 16px; border-radius: 8px;
            transition: background .15s, color .15s;
        }
        .nav-link:hover { background: var(--border); color: var(--ink); }
        .nav-btn {
            font-size: 13px; font-weight: 600; color: #fff;
            background: var(--ink); text-decoration: none;
            padding: 9px 20px; border-radius: 8px;
            transition: background .15s, transform .1s;
            font-family: 'Syne', sans-serif;
        }
        .nav-btn:hover { background: var(--accent); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            padding: 5rem 2rem 3rem;
            max-width: 900px; margin: 0 auto;
            text-align: center;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--ink); color: #fff;
            font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;
            padding: 6px 14px; border-radius: 100px; margin-bottom: 2rem;
            animation: fadeDown .5s ease both;
        }
        .hero-badge span { width: 6px; height: 6px; border-radius: 50%; background: var(--accent); display: inline-block; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }
        @keyframes fadeDown { from{opacity:0;transform:translateY(-10px)} to{opacity:1;transform:none} }
        @keyframes fadeUp   { from{opacity:0;transform:translateY(16px)}  to{opacity:1;transform:none} }

        .hero h1 {
            font-size: clamp(36px, 6vw, 64px);
            font-weight: 800; line-height: 1.05;
            letter-spacing: -.04em; color: var(--ink);
            margin-bottom: 1.25rem;
            animation: fadeUp .6s .1s ease both;
        }
        .hero h1 em { font-style: normal; color: var(--accent); }
        .hero p {
            font-size: 16px; line-height: 1.7; color: var(--ink-3);
            max-width: 520px; margin: 0 auto 2.5rem;
            animation: fadeUp .6s .2s ease both;
        }

        /* ── SEARCH BOX ── */
        .search-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 10px;
            display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
            max-width: 780px; margin: 0 auto;
            animation: fadeUp .6s .3s ease both;
        }
        .sf {
            display: flex; align-items: center; gap: 8px;
            flex: 1; min-width: 150px;
            border: 1px solid var(--border); border-radius: 10px;
            background: var(--surface);
            padding: 10px 14px;
        }
        .sf svg { width: 16px; height: 16px; color: var(--ink-3); flex-shrink: 0; }
        .sf input, .sf select {
            border: none; background: transparent; outline: none;
            font-size: 13px; color: var(--ink); width: 100%;
            font-family: 'Instrument Sans', sans-serif;
        }
        .sf select { cursor: pointer; }
        .sf input::placeholder { color: var(--ink-3); }
        .btn-search {
            background: var(--accent); color: #fff;
            border: none; border-radius: 10px;
            padding: 12px 24px; font-size: 13px; font-weight: 700;
            font-family: 'Syne', sans-serif; cursor: pointer; white-space: nowrap;
            display: flex; align-items: center; gap: 6px;
            transition: background .15s, transform .1s;
        }
        .btn-search:hover { background: #D94000; transform: scale(1.02); }

        /* ── TAGS ── */
        .tags-row {
            display: flex; flex-wrap: wrap; justify-content: center; gap: 8px;
            margin-top: 1.5rem;
            animation: fadeUp .6s .4s ease both;
        }
        .tag-label { font-size: 12px; color: var(--ink-3); align-self: center; }
        .tag {
            font-size: 12px; font-weight: 500; color: var(--ink-2);
            padding: 5px 14px; border-radius: 100px;
            border: 1px solid var(--border); background: var(--card);
            cursor: pointer; transition: all .15s;
        }
        .tag:hover { border-color: var(--accent); color: var(--accent); background: #fff5f2; }

        /* ── STATS ── */
        .stats {
            display: grid; grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
            margin: 4rem 0 0; background: var(--card);
        }
        .stat {
            padding: 1.8rem 1rem; text-align: center;
            border-right: 1px solid var(--border);
        }
        .stat:last-child { border-right: none; }
        .stat-n {
            font-family: 'Syne', sans-serif; font-size: 32px; font-weight: 800;
            letter-spacing: -.04em; color: var(--ink);
        }
        .stat-n span { color: var(--accent); }
        .stat-l { font-size: 12px; color: var(--ink-3); margin-top: 4px; font-weight: 500; }

        /* ── SECTIONS ── */
        .section { max-width: 900px; margin: 0 auto; padding: 3rem 2rem; }
        .section-head {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;
        }
        .section-head h2 {
            font-size: 24px; font-weight: 700; letter-spacing: -.03em; color: var(--ink);
        }
        .section-head p { font-size: 13px; color: var(--ink-3); margin-top: 4px; }
        .see-all {
            font-size: 12px; font-weight: 600; color: var(--accent);
            text-decoration: none; white-space: nowrap;
            display: flex; align-items: center; gap: 4px;
        }
        .see-all:hover { text-decoration: underline; }

        /* ── FILTER BAR ── */
        .filter-bar { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 1.2rem; }
        .f-btn {
            font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 100px;
            border: 1px solid var(--border); background: var(--card);
            color: var(--ink-2); cursor: pointer; font-family: 'Instrument Sans', sans-serif;
            transition: all .15s;
        }
        .f-btn:hover, .f-btn.active { background: var(--ink); color: #fff; border-color: var(--ink); }

        /* ── OFFER CARDS ── */
        .offer-card {
            background: var(--card); border: 1px solid var(--border); border-radius: 14px;
            padding: 1.1rem 1.25rem; margin-bottom: 10px;
            display: flex; flex-wrap: wrap; gap: 14px; align-items: center;
            transition: box-shadow .2s, border-color .2s, transform .15s;
        }
        .offer-card:hover {
            border-color: var(--ink); box-shadow: 4px 4px 0 var(--ink);
            transform: translate(-2px, -2px);
        }
        .o-logo {
            width: 48px; height: 48px; border-radius: 10px;
            display: grid; place-items: center; flex-shrink: 0; font-size: 20px;
        }
        .o-info { flex: 1; min-width: 200px; }
        .o-company { font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; margin-bottom: 3px; }
        .o-title { font-size: 15px; font-weight: 600; font-family: 'Syne', sans-serif; color: var(--ink); margin-bottom: 8px; }
        .o-meta { display: flex; flex-wrap: wrap; gap: 12px; font-size: 12px; color: var(--ink-3); }
        .o-meta span { display: flex; align-items: center; gap: 4px; }
        .o-meta svg { width: 13px; height: 13px; }
        .o-right { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .o-contract {
            font-size: 11px; font-weight: 700; letter-spacing: .04em;
            padding: 4px 10px; border-radius: 6px;
        }
        .o-score {
            font-size: 12px; font-weight: 700;
            padding: 5px 12px; border-radius: 100px;
            display: flex; align-items: center; gap: 5px;
        }
        .score-hi  { background: var(--green-lt); color: var(--green); }
        .score-mid { background: var(--amber-lt); color: var(--amber); }
        .score-lo  { background: #FEE2E2; color: #B91C1C; }
        .contract-cdi  { background: var(--blue-lt); color: var(--blue); }
        .contract-stage { background: var(--amber-lt); color: var(--amber); }
        .contract-alt   { background: var(--green-lt); color: var(--green); }
        .btn-voir {
            font-size: 12px; font-weight: 700; font-family: 'Syne', sans-serif;
            padding: 8px 18px; border-radius: 8px;
            border: 1.5px solid var(--ink); background: transparent; color: var(--ink);
            cursor: pointer; transition: all .15s;
        }
        .btn-voir:hover { background: var(--ink); color: #fff; }

        /* ── FEATURES ── */
        .features {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 12px;
        }
        .feat {
            background: var(--card); border: 1px solid var(--border); border-radius: 14px;
            padding: 1.4rem 1.2rem;
            transition: box-shadow .2s, border-color .2s, transform .15s;
        }
        .feat:hover {
            border-color: var(--ink); box-shadow: 4px 4px 0 var(--ink);
            transform: translate(-2px, -2px);
        }
        .feat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: grid; place-items: center; margin-bottom: 1rem; font-size: 22px;
        }
        .feat h3 { font-size: 15px; font-weight: 700; margin-bottom: 8px; font-family: 'Syne', sans-serif; }
        .feat p  { font-size: 13px; color: var(--ink-3); line-height: 1.6; }

        /* ── HOW IT WORKS ── */
        .steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0; }
        .step {
            padding: 2rem 1.5rem; border-right: 1px solid var(--border);
            position: relative;
        }
        .step:last-child { border-right: none; }
        .step-n {
            font-family: 'Syne', sans-serif; font-size: 48px; font-weight: 800;
            color: var(--border); line-height: 1; margin-bottom: .5rem;
        }
        .step h3 { font-size: 15px; font-weight: 700; margin-bottom: 8px; }
        .step p   { font-size: 13px; color: var(--ink-3); line-height: 1.6; }
        .steps-wrap {
            background: var(--card); border: 1px solid var(--border); border-radius: 14px;
            overflow: hidden;
        }

        /* ── CTA ── */
        .cta-wrap {
            background: var(--ink); border-radius: 20px;
            padding: 3.5rem 2rem; text-align: center;
            margin: 0 2rem 4rem; position: relative; overflow: hidden;
        }
        .cta-wrap::before {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 220px; height: 220px; border-radius: 50%;
            background: var(--accent); opacity: .12;
        }
        .cta-wrap::after {
            content: ''; position: absolute; bottom: -40px; left: -40px;
            width: 160px; height: 160px; border-radius: 50%;
            background: var(--accent-2); opacity: .1;
        }
        .cta-wrap h2 {
            font-size: 32px; font-weight: 800; color: #fff; letter-spacing: -.03em;
            margin-bottom: 12px;
        }
        .cta-wrap p { font-size: 14px; color: rgba(255,255,255,.55); margin-bottom: 2rem; }
        .cta-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }
        .cta-btn-p {
            background: var(--accent); color: #fff;
            border: none; border-radius: 10px; padding: 13px 28px;
            font-size: 14px; font-weight: 700; font-family: 'Syne', sans-serif;
            cursor: pointer; text-decoration: none;
            transition: background .15s, transform .1s;
        }
        .cta-btn-p:hover { background: #D94000; transform: translateY(-2px); }
        .cta-btn-o {
            background: transparent; color: #fff;
            border: 1.5px solid rgba(255,255,255,.3); border-radius: 10px;
            padding: 13px 28px; font-size: 14px; font-weight: 700;
            font-family: 'Syne', sans-serif; cursor: pointer; text-decoration: none;
            transition: background .15s, transform .1s;
        }
        .cta-btn-o:hover { background: rgba(255,255,255,.08); transform: translateY(-2px); }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 1.5rem 2rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
        }
        .footer-logo { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; }
        .footer-logo span { color: var(--accent); }
        footer p { font-size: 12px; color: var(--ink-3); }

        @media (max-width: 640px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
            .stat { border-bottom: 1px solid var(--border); }
            nav .nav-links a:not(.nav-btn) { display: none; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <a href="/" class="logo">
        <div class="logo-dot">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <span class="logo-text">Librisky<span>Jobs</span></span>
    </a>
    @if (Route::has('login'))
    <div class="nav-links">
        @auth
            <a href="{{ url('/dashboard') }}" class="nav-btn">Mon tableau de bord</a>
        @else
            <a href="{{ route('login') }}" class="nav-link">Se connecter</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-btn">Créer un compte</a>
            @endif
        @endauth
    </div>
    @endif
</nav>

<!-- HERO -->
<div class="hero">
    <div class="hero-badge"><span></span> Nouveau — Matching IA en temps réel</div>
    <h1>Le portail emploi qui <em>comprend</em> votre profil</h1>
    <p>Librisky Jobs analyse votre CV et calcule instantanément votre compatibilité avec chaque offre. Plus de candidatures dans le vide.</p>

    <div class="search-wrap">
        <div class="sf" style="flex:2;min-width:180px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" placeholder="Poste, compétences, mots-clés...">
        </div>
        <div class="sf" style="max-width:180px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <input type="text" placeholder="Ville, région...">
        </div>
        <div class="sf" style="max-width:150px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
            <select>
                <option>Tous contrats</option>
                <option>CDI</option>
                <option>CDD</option>
                <option>Stage</option>
                <option>Alternance</option>
                <option>Freelance</option>
            </select>
        </div>
        <button class="btn-search">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Rechercher
        </button>
    </div>

    <div class="tags-row">
        <span class="tag-label">Populaire :</span>
        <span class="tag">Développeur web</span>
        <span class="tag">Marketing digital</span>
        <span class="tag">Commercial</span>
        <span class="tag">Remote</span>
        <span class="tag">Stage fin d'études</span>
        <span class="tag">Comptable</span>
        <span class="tag">UI/UX Design</span>
        <span class="tag">Data analyst</span>
    </div>
</div>

<!-- STATS -->
<div class="stats">
    <div class="stat"><div class="stat-n">1 240<span>+</span></div><div class="stat-l">Offres actives</div></div>
    <div class="stat"><div class="stat-n">380<span>+</span></div><div class="stat-l">Recruteurs inscrits</div></div>
    <div class="stat"><div class="stat-n">5 600<span>+</span></div><div class="stat-l">Candidats</div></div>
    <div class="stat"><div class="stat-n">92<span>%</span></div><div class="stat-l">Taux de satisfaction</div></div>
</div>

<!-- OFFRES -->
<div class="section">
    <div class="section-head">
        <div>
            <h2>Offres récentes</h2>
            <p>Mises à jour en temps réel · 3 offres simulées</p>
        </div>
        <a href="#" class="see-all">Voir toutes les offres →</a>
    </div>

    <div class="filter-bar">
        <button class="f-btn active" onclick="setFilter(this,'all')">Tous</button>
        <button class="f-btn" onclick="setFilter(this,'cdi')">CDI</button>
        <button class="f-btn" onclick="setFilter(this,'stage')">Stage</button>
        <button class="f-btn" onclick="setFilter(this,'alt')">Alternance</button>
        <button class="f-btn" onclick="setFilter(this,'remote')">Remote</button>
        <button class="f-btn" onclick="setFilter(this,'dakar')">Dakar</button>
    </div>

    <div id="offers">
        <!-- Offre 1 -->
        <div class="offer-card" data-tags="cdi dakar">
            <div class="o-logo" style="background:#EBF2FF">💻</div>
            <div class="o-info">
                <div class="o-company" style="color:var(--blue)">TechCorp Solutions</div>
                <div class="o-title">Ingénieur web PHP / Laravel</div>
                <div class="o-meta">
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>Dakar, Sénégal</span>
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Publié aujourd'hui</span>
                    <span>2–4 ans d'exp.</span>
                </div>
            </div>
            <div class="o-right">
                <div style="display:flex;gap:8px;align-items:center">
                    <span class="o-contract contract-cdi">CDI</span>
                    <span class="o-score score-hi">🎯 95%</span>
                </div>
                <button class="btn-voir">Voir l'offre</button>
            </div>
        </div>

        <!-- Offre 2 -->
        <div class="offer-card" data-tags="stage remote">
            <div class="o-logo" style="background:#FDF2F8">🎨</div>
            <div class="o-info">
                <div class="o-company" style="color:#9333EA">Studio Digital Innov</div>
                <div class="o-title">UI/UX Designer junior</div>
                <div class="o-meta">
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0114.08 0M1.42 9a16 16 0 0121.16 0M8.53 16.11a6 6 0 016.95 0M12 20h.01"/></svg>Télétravail total</span>
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Hier</span>
                    <span>Profil junior accepté</span>
                </div>
            </div>
            <div class="o-right">
                <div style="display:flex;gap:8px;align-items:center">
                    <span class="o-contract contract-stage">Stage</span>
                    <span class="o-score score-mid">🎯 78%</span>
                </div>
                <button class="btn-voir">Voir l'offre</button>
            </div>
        </div>

        <!-- Offre 3 -->
        <div class="offer-card" data-tags="alt dakar">
            <div class="o-logo" style="background:#F0FDF4">📱</div>
            <div class="o-info">
                <div class="o-company" style="color:var(--green)">FinTech Labs</div>
                <div class="o-title">Développeur mobile Flutter / Dart</div>
                <div class="o-meta">
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>Dakar, Sénégal</span>
                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Il y a 3 jours</span>
                    <span>1–3 ans d'exp.</span>
                </div>
            </div>
            <div class="o-right">
                <div style="display:flex;gap:8px;align-items:center">
                    <span class="o-contract contract-alt">Alternance</span>
                    <span class="o-score score-hi">🎯 91%</span>
                </div>
                <button class="btn-voir">Voir l'offre</button>
            </div>
        </div>
    </div>
</div>

<!-- COMMENT ÇA MARCHE -->
<div style="background:var(--card);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:3rem 2rem;margin-bottom:0">
    <div style="max-width:900px;margin:0 auto">
        <div class="section-head" style="margin-bottom:2rem">
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:24px;font-weight:700;letter-spacing:-.03em">Comment ça marche ?</h2>
                <p style="font-size:13px;color:var(--ink-3);margin-top:4px">Postuler n'a jamais été aussi simple</p>
            </div>
        </div>
        <div class="steps-wrap">
            <div class="steps">
                <div class="step">
                    <div class="step-n">01</div>
                    <h3>Créez votre compte</h3>
                    <p>Inscrivez-vous en 30 secondes en tant que candidat ou recruteur.</p>
                </div>
                <div class="step">
                    <div class="step-n">02</div>
                    <h3>Déposez votre CV</h3>
                    <p>Importez votre CV PDF une seule fois, il sera joint à toutes vos candidatures.</p>
                </div>
                <div class="step">
                    <div class="step-n">03</div>
                    <h3>Postulez aux offres</h3>
                    <p>Parcourez les offres filtrées et postulez en un clic avec votre lettre de motivation.</p>
                </div>
                <div class="step">
                    <div class="step-n">04</div>
                    <h3>Suivez en temps réel</h3>
                    <p>Recevez les mises à jour de statut directement dans votre tableau de bord.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<div class="section">
    <div class="section-head">
        <div>
            <h2>Pourquoi Librisky Jobs ?</h2>
            <p>Des outils pensés pour candidats et recruteurs</p>
        </div>
    </div>
    <div class="features">
        <div class="feat">
            <div class="feat-icon" style="background:#FFF2EE">🎯</div>
            <h3>Matching intelligent</h3>
            <p>Score de compatibilité calculé automatiquement entre votre profil et chaque offre.</p>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:var(--green-lt)">📄</div>
            <h3>CV en un clic</h3>
            <p>Déposez votre CV PDF une fois et postulez à toutes les offres sans ressaisir vos infos.</p>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:var(--amber-lt)">🔔</div>
            <h3>Suivi en temps réel</h3>
            <p>Notification immédiate dès que le recruteur valide ou refuse votre candidature.</p>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:var(--blue-lt)">🏢</div>
            <h3>Espace recruteur</h3>
            <p>Publiez vos offres, gérez vos candidats et acceptez les profils depuis un dashboard dédié.</p>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-wrap">
    <h2>Prêt à trouver votre prochain poste ?</h2>
    <p>Rejoignez des milliers de candidats et recruteurs déjà sur la plateforme.</p>
    <div class="cta-btns">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="cta-btn-p">Créer un compte gratuit</a>
        @endif
        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="cta-btn-o">Se connecter</a>
        @endif
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-logo">Librisky<span>Jobs</span></div>
    <p>© 2026 — Projet de soutenance de Licence en Informatique</p>
</footer>

<script>
function setFilter(btn, filter) {
    document.querySelectorAll('.f-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.offer-card').forEach(card => {
        if (filter === 'all') {
            card.style.display = '';
        } else {
            const tags = card.dataset.tags || '';
            card.style.display = tags.includes(filter) ? '' : 'none';
        }
    });
}
</script>
</body>
</html>