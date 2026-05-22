<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
            <a href="{{ route('dashboard') }}" style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:#7A7A7A;text-decoration:none;padding:6px 12px;border:1px solid #E5E2DA;border-radius:8px;transition:all .15s" onmouseover="this.style.color='#0D0D0D';this.style.borderColor='#0D0D0D'" onmouseout="this.style.color='#7A7A7A';this.style.borderColor='#E5E2DA'">
                ← Retour
            </a>
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;letter-spacing:-.03em;color:#0D0D0D">
                    Candidatures — {{ $offer->title }}
                </h2>
                <p style="font-size:12px;color:#7A7A7A;margin-top:2px">
                    {{ $offer->company_name }} · {{ $offer->location }}
                </p>
            </div>
        </div>
    </x-slot>

    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800|instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        :root{--ink:#0D0D0D;--ink-2:#3A3A3A;--ink-3:#7A7A7A;--surface:#F7F5F0;--card:#FFFFFF;--accent:#FF4D00;--blue:#1A56DB;--blue-lt:#EBF2FF;--green:#0A7A3E;--green-lt:#E6F7EE;--amber:#B45309;--amber-lt:#FEF3C7;--red:#B91C1C;--red-lt:#FEE2E2;--border:#E5E2DA}
        *{box-sizing:border-box}
        body{font-family:'Instrument Sans',sans-serif;background:var(--surface);color:var(--ink)}
        h1,h2,h3,h4,.syne{font-family:'Syne',sans-serif}

        .page-wrap{max-width:860px;margin:2.5rem auto;padding:0 1.5rem 4rem}

        /* INFO BAR */
        .info-bar{
            background:var(--card);border:1px solid var(--border);border-radius:12px;
            padding:1rem 1.4rem;margin-bottom:1.5rem;
            display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem
        }
        .info-bar-left{display:flex;align-items:center;gap:12px}
        .info-icon{width:40px;height:40px;border-radius:9px;background:var(--ink);display:grid;place-items:center;flex-shrink:0}
        .info-bar h3{font-size:14px;font-weight:700;letter-spacing:-.02em}
        .info-bar p{font-size:12px;color:var(--ink-3);margin-top:2px}
        .info-chips{display:flex;flex-wrap:wrap;gap:6px}
        .chip{display:inline-flex;align-items:center;gap:5px;font-size:11px;font-weight:600;padding:4px 10px;border-radius:100px;background:var(--surface);border:1px solid var(--border);color:var(--ink-2)}

        /* EMPTY */
        .empty{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:4rem 2rem;text-align:center;color:var(--ink-3)}
        .empty-icon{font-size:40px;margin-bottom:1rem}
        .empty p{font-size:14px}

        /* CANDIDATE CARD */
        .cand-card{
            background:var(--card);border:1px solid var(--border);border-radius:16px;
            margin-bottom:12px;overflow:hidden;
            transition:box-shadow .2s,border-color .2s,transform .15s
        }
        .cand-card:hover{border-color:var(--ink);box-shadow:4px 4px 0 var(--ink);transform:translate(-2px,-2px)}

        .cand-head{
            padding:1.2rem 1.5rem;
            display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;
            border-bottom:1px solid var(--border)
        }
        .cand-left{display:flex;align-items:center;gap:12px}
        .avatar{
            width:46px;height:46px;border-radius:50%;
            background:var(--ink);display:grid;place-items:center;
            font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:#fff;flex-shrink:0
        }
        .cand-name{font-size:15px;font-weight:700;font-family:'Syne',sans-serif;color:var(--ink)}
        .cand-meta{font-size:12px;color:var(--ink-3);margin-top:3px;display:flex;flex-wrap:wrap;gap:8px}
        .cand-meta span{display:flex;align-items:center;gap:4px}

        .cand-right{display:flex;flex-wrap:wrap;align-items:center;gap:8px}

        /* SCORE */
        .score-wrap{display:flex;align-items:center;gap:8px}
        .score-label{font-size:10px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--ink-3)}
        .badge{display:inline-flex;align-items:center;padding:4px 10px;border-radius:100px;font-size:11px;font-weight:700;white-space:nowrap}
        .badge-green{background:var(--green-lt);color:var(--green)}
        .badge-amber{background:var(--amber-lt);color:var(--amber)}
        .badge-red{background:var(--red-lt);color:var(--red)}

        .score-track{width:60px;height:4px;border-radius:2px;background:var(--border)}
        .score-fill{height:4px;border-radius:2px}

        /* CV BUTTON */
        .btn-cv{
            display:inline-flex;align-items:center;gap:6px;
            background:var(--ink);color:#fff;text-decoration:none;
            font-family:'Syne',sans-serif;font-size:11px;font-weight:700;
            padding:8px 16px;border-radius:8px;
            transition:background .15s,transform .1s
        }
        .btn-cv:hover{background:var(--accent);transform:translateY(-1px)}

        /* COVER LETTER */
        .cover-body{padding:1.2rem 1.5rem}
        .cover-label{font-size:10px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--ink-3);margin-bottom:10px;display:flex;align-items:center;gap:6px}
        .cover-label::after{content:'';flex:1;height:1px;background:var(--border)}
        .cover-text{
            font-size:13px;color:var(--ink-2);line-height:1.7;
            background:var(--surface);border:1px solid var(--border);
            border-radius:10px;padding:1rem 1.2rem;
            font-style:italic;white-space:pre-line
        }
        .cover-text::before{content:'"';font-size:28px;line-height:.8;color:var(--border);font-style:normal;display:block;margin-bottom:4px;font-family:'Syne',sans-serif}
        .no-cover{font-size:12px;color:var(--ink-3);font-style:italic;padding:.5rem 0}

        /* COUNT BADGE */
        .count-badge{
            display:inline-flex;align-items:center;gap:5px;
            font-size:12px;font-weight:700;font-family:'Syne',sans-serif;
            background:var(--ink);color:#fff;
            padding:5px 14px;border-radius:100px
        }
    </style>

    <div class="page-wrap">

        {{-- INFO BAR --}}
        <div class="info-bar">
            <div class="info-bar-left">
                <div class="info-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
                </div>
                <div>
                    <h3>{{ $offer->title }}</h3>
                    <p>{{ $offer->company_name }} · {{ $offer->location }}</p>
                </div>
            </div>
            <div class="info-chips">
                <span class="chip">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    {{ $applications->count() }} candidat(s)
                </span>
                <span class="chip">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/></svg>
                    {{ $offer->contract_type }}
                </span>
            </div>
        </div>

        {{-- EMPTY STATE --}}
        @if($applications->isEmpty())
            <div class="empty">
                <div class="empty-icon">📭</div>
                <p>Aucun candidat n'a encore postulé à cette offre.</p>
            </div>

        {{-- CANDIDATE CARDS --}}
        @else
            @foreach($applications as $application)
                @php
                    $initials = collect(explode(' ', $application->user->name))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
                    $s = $application->match_score;
                    $scoreClass = $s >= 70 ? 'badge-green' : ($s >= 40 ? 'badge-amber' : 'badge-red');
                    $scoreLabel = $s >= 70 ? 'Profil idéal' : ($s >= 40 ? 'Profil moyen' : 'Faible');
                    $scoreColor = $s >= 70 ? 'var(--green)' : ($s >= 40 ? 'var(--amber)' : 'var(--red)');
                @endphp
                <div class="cand-card">
                    <div class="cand-head">
                        <div class="cand-left">
                            <div class="avatar">{{ $initials }}</div>
                            <div>
                                <div class="cand-name">{{ $application->user->name }}</div>
                                <div class="cand-meta">
                                    <span>
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                        {{ $application->user->email }}
                                    </span>
                                    <span>
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        {{ $application->created_at->format('d/m/Y à H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="cand-right">
                            <div class="score-wrap">
                                <span class="score-label">Score</span>
                                <span class="badge {{ $scoreClass }}">{{ $s }}% — {{ $scoreLabel }}</span>
                                <div class="score-track">
                                    <div class="score-fill" style="width:{{ $s }}%;background:{{ $scoreColor }}"></div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="btn-cv">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                Ouvrir le CV
                            </a>
                        </div>
                    </div>

                    <div class="cover-body">
                        @if($application->cover_letter)
                            <div class="cover-label">Lettre de motivation</div>
                            <div class="cover-text">{{ $application->cover_letter }}</div>
                        @else
                            <p class="no-cover">Le candidat n'a pas laissé de message d'accompagnement.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>