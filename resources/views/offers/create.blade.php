<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px">
            <a href="{{ route('dashboard') }}" style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:#7A7A7A;text-decoration:none;padding:6px 12px;border:1px solid #E5E2DA;border-radius:8px;transition:all .15s" onmouseover="this.style.color='#0D0D0D';this.style.borderColor='#0D0D0D'" onmouseout="this.style.color='#7A7A7A';this.style.borderColor='#E5E2DA'">
                ← Retour
            </a>
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;letter-spacing:-.03em;color:#0D0D0D">Publier une offre</h2>
                <p style="font-size:12px;color:#7A7A7A;margin-top:2px">Remplissez les informations ci-dessous</p>
            </div>
        </div>
    </x-slot>

    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800|instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        :root{--ink:#0D0D0D;--ink-2:#3A3A3A;--ink-3:#7A7A7A;--surface:#F7F5F0;--card:#FFFFFF;--accent:#FF4D00;--blue:#1A56DB;--border:#E5E2DA;--danger:#B91C1C;--danger-lt:#FEE2E2}
        *{box-sizing:border-box}
        body{font-family:'Instrument Sans',sans-serif;background:var(--surface);color:var(--ink)}
        h1,h2,h3,.syne{font-family:'Syne',sans-serif}

        .form-wrap{max-width:720px;margin:2.5rem auto;padding:0 1.5rem 4rem}

        .form-card{background:var(--card);border:1px solid var(--border);border-radius:18px;overflow:hidden}

        .form-card-head{
            padding:1.8rem 2rem 1.4rem;
            border-bottom:1px solid var(--border);
            display:flex;align-items:center;gap:14px
        }
        .form-card-head .head-icon{
            width:46px;height:46px;border-radius:11px;
            background:#0D0D0D;display:grid;place-items:center;flex-shrink:0
        }
        .form-card-head h3{font-size:17px;font-weight:700;letter-spacing:-.03em;color:var(--ink)}
        .form-card-head p{font-size:12px;color:var(--ink-3);margin-top:3px}

        .form-body{padding:2rem}

        .form-group{margin-bottom:1.5rem}
        .form-label{
            display:block;font-size:12px;font-weight:700;
            letter-spacing:.05em;text-transform:uppercase;
            color:var(--ink-2);margin-bottom:8px
        }
        .form-label span{color:var(--accent);margin-left:2px}
        .form-hint{font-size:11px;color:var(--ink-3);margin-top:5px}

        .f-input,.f-select,.f-textarea{
            width:100%;padding:11px 14px;
            border:1px solid var(--border);border-radius:10px;
            background:var(--surface);
            font-size:14px;color:var(--ink);
            font-family:'Instrument Sans',sans-serif;
            outline:none;transition:border-color .15s,box-shadow .15s
        }
        .f-input:focus,.f-select:focus,.f-textarea:focus{
            border-color:var(--ink);
            box-shadow:0 0 0 3px rgba(13,13,13,.06);
            background:#fff
        }
        .f-input::placeholder,.f-textarea::placeholder{color:#B4B2A9}
        .f-select{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237A7A7A' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center}
        .f-textarea{resize:vertical;min-height:140px;line-height:1.6}

        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem}
        @media(max-width:560px){.form-row{grid-template-columns:1fr}}

        .form-footer{
            padding:1.4rem 2rem;
            border-top:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap
        }
        .btn-cancel{
            font-size:13px;font-weight:600;color:var(--ink-3);
            text-decoration:none;padding:10px 18px;border-radius:9px;
            border:1px solid var(--border);background:transparent;
            transition:all .15s;cursor:pointer;font-family:'Instrument Sans',sans-serif
        }
        .btn-cancel:hover{color:var(--ink);border-color:var(--ink)}
        .btn-publish{
            background:var(--ink);color:#fff;border:none;border-radius:9px;
            padding:11px 28px;font-size:13px;font-weight:700;
            font-family:'Syne',sans-serif;cursor:pointer;
            display:inline-flex;align-items:center;gap:7px;
            transition:background .15s,transform .1s
        }
        .btn-publish:hover{background:var(--accent);transform:translateY(-1px)}

        .error-msg{
            font-size:11px;color:var(--danger);margin-top:5px;
            display:flex;align-items:center;gap:4px
        }

        /* optional badge */
        .opt-badge{
            font-size:10px;font-weight:700;letter-spacing:.04em;
            background:#F1EFE8;color:#7A7A7A;
            padding:2px 8px;border-radius:4px;margin-left:6px;vertical-align:middle
        }
    </style>

    <div class="form-wrap">
        <div class="form-card">

            <div class="form-card-head">
                <div class="head-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
                </div>
                <div>
                    <h3>Nouvelle offre d'emploi</h3>
                    <p>Tous les champs marqués <span style="color:var(--accent)">*</span> sont obligatoires</p>
                </div>
            </div>

            <form action="{{ route('offers.store') }}" method="POST">
                @csrf
                <div class="form-body">

                    {{-- INTITULÉ --}}
                    <div class="form-group">
                        <label class="form-label" for="title">Intitulé du poste <span>*</span></label>
                        <input id="title" name="title" type="text" class="f-input" placeholder="ex : Développeur Full-Stack Laravel" required autofocus value="{{ old('title') }}">
                        @error('title')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                    </div>

                    {{-- ENTREPRISE --}}
                    <div class="form-group">
                        <label class="form-label" for="company_name">Nom de l'entreprise <span>*</span></label>
                        <input id="company_name" name="company_name" type="text" class="f-input" placeholder="ex : TechCorp Solutions" required value="{{ old('company_name') }}">
                        @error('company_name')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                    </div>

                    {{-- LIEU + CONTRAT --}}
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label" for="location">Lieu <span>*</span></label>
                            <input id="location" name="location" type="text" class="f-input" placeholder="ex : Dakar, Télétravail" required value="{{ old('location') }}">
                            @error('location')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label" for="contract_type">Type de contrat <span>*</span></label>
                            <select id="contract_type" name="contract_type" class="f-select" required>
                                <option value="">— Choisir —</option>
                                @foreach(['CDI','CDD','Stage','Alternance','Freelance'] as $ct)
                                    <option value="{{ $ct }}" {{ old('contract_type') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                                @endforeach
                            </select>
                            @error('contract_type')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- SALAIRE --}}
                    <div class="form-group" style="margin-top:1.5rem">
                        <label class="form-label" for="salary">Rémunération <span class="opt-badge">OPTIONNEL</span></label>
                        <input id="salary" name="salary" type="text" class="f-input" placeholder="ex : 400 000 — 600 000 FCFA / mois" value="{{ old('salary') }}">
                        <div class="form-hint">Laisser vide si vous ne souhaitez pas l'afficher.</div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="form-group">
                        <label class="form-label" for="description">Description du poste <span>*</span></label>
                        <textarea id="description" name="description" class="f-textarea" placeholder="Décrivez les missions, le profil recherché, les compétences requises..." required>{{ old('description') }}</textarea>
                        @error('description')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                        <div class="form-hint">Soyez précis — une bonne description attire les bons profils.</div>
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-publish">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Publier l'annonce
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>