<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;letter-spacing:-.03em;color:#0D0D0D">
                    @if(Auth::user()->role === 'recruiter')
                        Espace Recruteur
                    @else
                        Espace Candidat
                    @endif
                </h2>
                <p style="font-size:13px;color:#7A7A7A;margin-top:2px">
                    Bonjour, <strong>{{ Auth::user()->name }}</strong> 👋
                </p>
            </div>
            @if(Auth::user()->role === 'recruiter')
                <a href="{{ route('offers.create') }}" class="dash-btn-primary">+ Publier une offre</a>
            @endif
        </div>
    </x-slot>

    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800|instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        :root{
            --ink:#0D0D0D;--ink-2:#3A3A3A;--ink-3:#7A7A7A;
            --surface:#F7F5F0;--card:#FFFFFF;
            --accent:#FF4D00;--accent-2:#FFB800;
            --blue:#1A56DB;--blue-lt:#EBF2FF;
            --green:#0A7A3E;--green-lt:#E6F7EE;
            --amber:#B45309;--amber-lt:#FEF3C7;
            --red:#B91C1C;--red-lt:#FEE2E2;
            --border:#E5E2DA;
        }
        *{box-sizing:border-box}
        body{font-family:'Instrument Sans',sans-serif;background:var(--surface);color:var(--ink)}
        h1,h2,h3,h4,.syne{font-family:'Syne',sans-serif}

        .dash-wrap{max-width:1100px;margin:0 auto;padding:2rem 1.5rem}

        /* STAT CARDS */
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin-bottom:2rem}
        .stat-card{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:1.2rem 1.3rem;transition:box-shadow .2s,transform .15s}
        .stat-card:hover{box-shadow:4px 4px 0 var(--ink);transform:translate(-2px,-2px);border-color:var(--ink)}
        .stat-card .s-label{font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--ink-3);margin-bottom:8px}
        .stat-card .s-val{font-family:'Syne',sans-serif;font-size:30px;font-weight:800;letter-spacing:-.04em;color:var(--ink);line-height:1}
        .stat-card .s-sub{font-size:12px;color:var(--ink-3);margin-top:6px}
        .stat-card .s-dot{display:inline-block;width:8px;height:8px;border-radius:50%;margin-right:5px}

        /* SECTION BLOCKS */
        .block{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:1.5rem}
        .block-head{padding:1.2rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem}
        .block-head h3{font-size:15px;font-weight:700;letter-spacing:-.02em;color:var(--ink)}
        .block-head p{font-size:12px;color:var(--ink-3);margin-top:2px}
        .block-body{padding:1.5rem}

        /* TABLE */
        .dash-table{width:100%;border-collapse:collapse;font-size:13px}
        .dash-table thead tr{border-bottom:1px solid var(--border)}
        .dash-table th{padding:10px 14px;font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--ink-3);text-align:left;white-space:nowrap}
        .dash-table td{padding:12px 14px;border-bottom:1px solid var(--border);color:var(--ink-2);vertical-align:middle}
        .dash-table tr:last-child td{border-bottom:none}
        .dash-table tbody tr{transition:background .12s}
        .dash-table tbody tr:hover{background:#FAFAF8}
        .td-title{font-weight:600;color:var(--ink);font-family:'Syne',sans-serif;font-size:13px}
        .td-sub{font-size:11px;color:var(--ink-3);margin-top:2px}

        /* BADGES */
        .badge{display:inline-flex;align-items:center;padding:4px 10px;border-radius:100px;font-size:11px;font-weight:700;letter-spacing:.03em;white-space:nowrap}
        .badge-green{background:var(--green-lt);color:var(--green)}
        .badge-amber{background:var(--amber-lt);color:var(--amber)}
        .badge-red{background:var(--red-lt);color:var(--red)}
        .badge-blue{background:var(--blue-lt);color:var(--blue)}
        .badge-gray{background:#F1EFE8;color:#5F5E5A}
        .badge-ink{background:var(--ink);color:#fff}

        /* BUTTONS */
        .dash-btn-primary{
            display:inline-flex;align-items:center;gap:6px;
            background:var(--ink);color:#fff;text-decoration:none;
            font-family:'Syne',sans-serif;font-size:12px;font-weight:700;
            padding:10px 20px;border-radius:9px;border:none;cursor:pointer;
            transition:background .15s,transform .1s;white-space:nowrap
        }
        .dash-btn-primary:hover{background:var(--accent);transform:translateY(-1px)}
        .btn-sm{
            font-size:11px;font-weight:700;font-family:'Syne',sans-serif;
            padding:6px 14px;border-radius:7px;border:1.5px solid var(--border);
            background:transparent;color:var(--ink-2);cursor:pointer;
            transition:all .15s;text-decoration:none;display:inline-flex;align-items:center;gap:5px
        }
        .btn-sm:hover{border-color:var(--ink);color:var(--ink);background:#FAFAF8}
        .btn-accept{border-color:var(--green);color:var(--green)}
        .btn-accept:hover,.btn-accept.active{background:var(--green);color:#fff;border-color:var(--green)}
        .btn-accept.active{background:var(--green);color:#fff}
        .btn-refuse{border-color:var(--red);color:var(--red)}
        .btn-refuse:hover,.btn-refuse.active{background:var(--red);color:#fff;border-color:var(--red)}
        .btn-refuse.active{background:var(--red);color:#fff}
        .btn-danger{border:none;background:none;font-size:11px;font-weight:600;color:var(--ink-3);cursor:pointer;padding:4px 0;font-family:'Instrument Sans',sans-serif;transition:color .12s}
        .btn-danger:hover{color:var(--red)}

        /* OFFER CARDS (candidat) */
        .offer-card{
            background:var(--card);border:1px solid var(--border);border-radius:14px;
            padding:1.2rem 1.4rem;margin-bottom:10px;
            display:flex;flex-wrap:wrap;gap:14px;align-items:center;justify-content:space-between;
            transition:box-shadow .2s,border-color .2s,transform .15s
        }
        .offer-card:hover{border-color:var(--ink);box-shadow:4px 4px 0 var(--ink);transform:translate(-2px,-2px)}
        .o-logo{width:46px;height:46px;border-radius:10px;display:grid;place-items:center;font-size:20px;flex-shrink:0}
        .o-info{flex:1;min-width:200px}
        .o-company{font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-bottom:3px}
        .o-title{font-size:15px;font-weight:700;font-family:'Syne',sans-serif;color:var(--ink);margin-bottom:6px}
        .o-meta{display:flex;flex-wrap:wrap;gap:12px;font-size:12px;color:var(--ink-3)}
        .o-meta span{display:flex;align-items:center;gap:4px}
        .btn-postuler{
            background:var(--ink);color:#fff;text-decoration:none;
            font-family:'Syne',sans-serif;font-size:12px;font-weight:700;
            padding:10px 22px;border-radius:9px;white-space:nowrap;
            transition:background .15s,transform .1s;display:inline-block
        }
        .btn-postuler:hover{background:var(--accent);transform:translateY(-1px)}

        /* EMPTY STATE */
        .empty{text-align:center;padding:3rem 1rem;color:var(--ink-3)}
        .empty-icon{font-size:36px;margin-bottom:1rem}
        .empty p{font-size:13px}

        /* SCORE BAR */
        .score-bar{display:flex;align-items:center;gap:8px}
        .score-bar-track{flex:1;height:4px;border-radius:2px;background:var(--border);max-width:80px}
        .score-bar-fill{height:4px;border-radius:2px}

        /* CV LINK */
        .cv-link{
            display:inline-flex;align-items:center;gap:5px;
            font-size:11px;font-weight:700;color:var(--blue);
            text-decoration:none;padding:4px 10px;border-radius:6px;
            background:var(--blue-lt);transition:background .12s
        }
        .cv-link:hover{background:#DBEAFE}

        /* SECTION DIVIDER */
        .section-divider{display:flex;align-items:center;gap:1rem;margin:2rem 0 1.5rem}
        .section-divider h3{font-size:16px;font-weight:700;white-space:nowrap;font-family:'Syne',sans-serif}
        .section-divider::after{content:'';flex:1;height:1px;background:var(--border)}

        @media(max-width:640px){
            .dash-table th:nth-child(3),.dash-table td:nth-child(3){display:none}
            .stats-grid{grid-template-columns:repeat(2,1fr)}
        }
    </style>

    <div class="dash-wrap">

        {{-- ═══════════════════════════════════════ --}}
        {{-- ░░░  ESPACE RECRUTEUR  ░░░             --}}
        {{-- ═══════════════════════════════════════ --}}
        @if(Auth::user()->role === 'recruiter')

            {{-- STATS --}}
            @php
                $totalCandidatures = $recruiterApplications->count();
                $acceptes  = $recruiterApplications->where('status','accepte')->count();
                $refuses   = $recruiterApplications->where('status','refuse')->count();
                $enCours   = $recruiterApplications->where('status','en cours')->count();
            @endphp
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="s-label">Offres publiées</div>
                    <div class="s-val">{{ $myOffers->count() }}</div>
                    <div class="s-sub">annonces actives</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">Candidatures reçues</div>
                    <div class="s-val">{{ $totalCandidatures }}</div>
                    <div class="s-sub">au total</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">Acceptés</div>
                    <div class="s-val" style="color:var(--green)">{{ $acceptes }}</div>
                    <div class="s-sub"><span class="s-dot" style="background:var(--green)"></span>profils validés</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">En attente</div>
                    <div class="s-val" style="color:var(--amber)">{{ $enCours }}</div>
                    <div class="s-sub"><span class="s-dot" style="background:var(--amber)"></span>à traiter</div>
                </div>
            </div>

            {{-- MES OFFRES --}}
            <div class="block">
                <div class="block-head">
                    <div>
                        <h3>Vos annonces en ligne</h3>
                        <p>{{ $myOffers->count() }} offre(s) publiée(s)</p>
                    </div>
                    <a href="{{ route('offers.create') }}" class="dash-btn-primary">+ Nouvelle offre</a>
                </div>

                @if($myOffers->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">📭</div>
                        <p>Vous n'avez pas encore publié d'offre d'emploi.</p>
                    </div>
                @else
                    <div style="overflow-x:auto">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Entreprise</th>
                                    <th>Lieu</th>
                                    <th>Contrat</th>
                                    <th style="text-align:center">Candidatures</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myOffers as $myOffer)
                                    @php $count = \App\Models\Application::where('offer_id', $myOffer->id)->count(); @endphp
                                    <tr>
                                        <td><div class="td-title">{{ $myOffer->title }}</div></td>
                                        <td>{{ $myOffer->company_name }}</td>
                                        <td style="color:var(--ink-3)">
                                            <span style="display:flex;align-items:center;gap:4px">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                                {{ $myOffer->location }}
                                            </span>
                                        </td>
                                        <td><span class="badge badge-blue">{{ $myOffer->contract_type }}</span></td>
                                        <td style="text-align:center">
                                            <a href="{{ route('offers.applications', $myOffer->id) }}" class="btn-sm">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                                                Voir les CV ({{ $count }})
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- GESTION CANDIDATURES --}}
            <div class="block">
                <div class="block-head">
                    <div>
                        <h3>Gestion des candidatures reçues</h3>
                        <p>Acceptez ou refusez les profils — le candidat est notifié automatiquement</p>
                    </div>
                    @if($totalCandidatures > 0)
                        <span class="badge badge-ink">{{ $enCours }} en attente</span>
                    @endif
                </div>

                @if(isset($recruiterApplications) && !$recruiterApplications->isEmpty())
                    <div style="overflow-x:auto">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Candidat</th>
                                    <th>Poste visé</th>
                                    <th>Score</th>
                                    <th>Statut</th>
                                    <th>CV</th>
                                    <th style="text-align:right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recruiterApplications as $application)
                                    <tr>
                                        <td>
                                            <div class="td-title">{{ $application->user->name }}</div>
                                            <div class="td-sub">{{ $application->user->email }}</div>
                                        </td>
                                        <td style="font-weight:500;color:var(--ink)">{{ $application->offer->title ?? 'Offre supprimée' }}</td>
                                        <td>
                                            @php $s = $application->match_score; @endphp
                                            <div class="score-bar">
                                                <span class="badge {{ $s >= 70 ? 'badge-green' : ($s >= 40 ? 'badge-amber' : 'badge-red') }}">{{ $s }}%</span>
                                                <div class="score-bar-track">
                                                    <div class="score-bar-fill" style="width:{{ $s }}%;background:{{ $s >= 70 ? 'var(--green)' : ($s >= 40 ? 'var(--amber)' : 'var(--red)') }}"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($application->status === 'accepte')
                                                <span class="badge badge-green">✓ Accepté</span>
                                            @elseif($application->status === 'refuse')
                                                <span class="badge badge-red">✕ Refusé</span>
                                            @else
                                                <span class="badge badge-amber">⏳ En cours</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="cv-link">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                                CV PDF
                                            </a>
                                        </td>
                                        <td>
                                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;flex-wrap:wrap">
                                                <form action="{{ route('applications.update-status', [$application->id, 'accepte']) }}" method="POST" style="display:inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn-sm btn-accept {{ $application->status === 'accepte' ? 'active' : '' }}">✓ Accepter</button>
                                                </form>
                                                <form action="{{ route('applications.update-status', [$application->id, 'refuse']) }}" method="POST" style="display:inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn-sm btn-refuse {{ $application->status === 'refuse' ? 'active' : '' }}">✕ Refuser</button>
                                                </form>
                                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Retirer définitivement ce candidat ?')" style="display:inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-danger">Retirer</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty">
                        <div class="empty-icon">📬</div>
                        <p>Aucune candidature reçue pour le moment.</p>
                    </div>
                @endif
            </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- ░░░  ESPACE CANDIDAT  ░░░              --}}
        {{-- ═══════════════════════════════════════ --}}
        @else

            {{-- STATS CANDIDAT --}}
            @php
                $totalApp  = $applications->count();
                $acceptes  = $applications->where('status','accepte')->count();
                $refuses   = $applications->where('status','refuse')->count();
                $enCours   = $applications->where('status','en cours')->count();
            @endphp
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="s-label">Candidatures envoyées</div>
                    <div class="s-val">{{ $totalApp }}</div>
                    <div class="s-sub">au total</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">En attente</div>
                    <div class="s-val" style="color:var(--amber)">{{ $enCours }}</div>
                    <div class="s-sub"><span class="s-dot" style="background:var(--amber)"></span>réponse attendue</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">Acceptées</div>
                    <div class="s-val" style="color:var(--green)">{{ $acceptes }}</div>
                    <div class="s-sub"><span class="s-dot" style="background:var(--green)"></span>félicitations !</div>
                </div>
                <div class="stat-card">
                    <div class="s-label">Offres disponibles</div>
                    <div class="s-val" style="color:var(--blue)">{{ $offers->count() }}</div>
                    <div class="s-sub"><span class="s-dot" style="background:var(--blue)"></span>à explorer</div>
                </div>
            </div>

            {{-- MES CANDIDATURES --}}
            <div class="block">
                <div class="block-head">
                    <div>
                        <h3>Mes candidatures</h3>
                        <p>Historique de vos postulations</p>
                    </div>
                    @if($totalApp > 0)
                        <span class="badge badge-ink">{{ $totalApp }} envoyée(s)</span>
                    @endif
                </div>

                @if($applications->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">📤</div>
                        <p>Vous n'avez pas encore postulé à une offre.</p>
                    </div>
                @else
                    <div style="overflow-x:auto">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Entreprise</th>
                                    <th>Score</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td>
                                            <div class="td-title">{{ $application->offer->title ?? 'Poste supprimé' }}</div>
                                            <div class="td-sub">Postulé le {{ $application->created_at->format('d/m/Y') }}</div>
                                        </td>
                                        <td>{{ $application->offer->company_name ?? '—' }}</td>
                                        <td>
                                            @php $s = $application->match_score; @endphp
                                            <span class="badge {{ $s >= 70 ? 'badge-green' : ($s >= 40 ? 'badge-amber' : 'badge-red') }}">{{ $s }}%</span>
                                        </td>
                                        <td>
                                            @if($application->status === 'accepte')
                                                <span class="badge badge-green">✓ Accepté</span>
                                            @elseif($application->status === 'refuse')
                                                <span class="badge badge-red">✕ Refusé</span>
                                            @else
                                                <span class="badge badge-amber">⏳ En cours</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($application->status === 'en cours')
                                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Annuler cette candidature ?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-danger">✕ Annuler</button>
                                                </form>
                                            @else
                                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Masquer cette candidature ?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-danger">🗑 Masquer</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- OFFRES DISPONIBLES --}}
            <div class="section-divider"><h3>Offres disponibles</h3></div>

            @if($offers->isEmpty())
                <div class="empty">
                    <div class="empty-icon">🔍</div>
                    <p>Aucune offre d'emploi disponible pour le moment.</p>
                </div>
            @else
                @foreach($offers as $offer)
                    <div class="offer-card">
                        <div class="o-logo" style="background:{{ ['#EBF2FF','#F0FDF4','#FDF2F8','#FAEEDA','#F7F5F0'][($loop->index % 5)] }}">
                            {{ ['💻','🏢','🎨','📊','⚙️'][$loop->index % 5] }}
                        </div>
                        <div class="o-info">
                            <div class="o-company" style="color:var(--ink-3)">{{ $offer->company_name }}</div>
                            <div class="o-title">{{ $offer->title }}</div>
                            <div class="o-meta">
                                <span>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ $offer->location }}
                                </span>
                                @if($offer->salary)
                                    <span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                                        {{ $offer->salary }}
                                    </span>
                                @endif
                                <span class="badge badge-blue" style="font-size:10px">{{ $offer->contract_type }}</span>
                            </div>
                            @if($offer->description)
                                <p style="font-size:12px;color:var(--ink-3);margin-top:8px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                    {{ $offer->description }}
                                </p>
                            @endif
                        </div>
                        <a href="{{ route('applications.create', $offer->id) }}" class="btn-postuler">Postuler →</a>
                    </div>
                @endforeach
            @endif

        @endif
    </div>
</x-app-layout>