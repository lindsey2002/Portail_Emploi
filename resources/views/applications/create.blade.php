<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px">
            <a href="{{ route('dashboard') }}" style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:#7A7A7A;text-decoration:none;padding:6px 12px;border:1px solid #E5E2DA;border-radius:8px;transition:all .15s" onmouseover="this.style.color='#0D0D0D';this.style.borderColor='#0D0D0D'" onmouseout="this.style.color='#7A7A7A';this.style.borderColor='#E5E2DA'">
                ← Retour
            </a>
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;letter-spacing:-.03em;color:#0D0D0D">Déposer ma candidature</h2>
                <p style="font-size:12px;color:#7A7A7A;margin-top:2px">Complétez le formulaire ci-dessous</p>
            </div>
        </div>
    </x-slot>

    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800|instrument-sans:400,500,600" rel="stylesheet"/>
    <style>
        :root{--ink:#0D0D0D;--ink-2:#3A3A3A;--ink-3:#7A7A7A;--surface:#F7F5F0;--card:#FFFFFF;--accent:#FF4D00;--blue:#1A56DB;--blue-lt:#EBF2FF;--green:#0A7A3E;--green-lt:#E6F7EE;--border:#E5E2DA;--danger:#B91C1C}
        *{box-sizing:border-box}
        body{font-family:'Instrument Sans',sans-serif;background:var(--surface);color:var(--ink)}
        h1,h2,h3,h4,.syne{font-family:'Syne',sans-serif}

        .form-wrap{max-width:680px;margin:2.5rem auto;padding:0 1.5rem 4rem}

        /* OFFER RECAP */
        .offer-recap{
            background:var(--ink);border-radius:14px;
            padding:1.3rem 1.5rem;margin-bottom:1.5rem;
            display:flex;align-items:center;gap:14px
        }
        .offer-recap-icon{width:44px;height:44px;border-radius:10px;background:rgba(255,255,255,.1);display:grid;place-items:center;flex-shrink:0}
        .offer-recap-title{font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:#fff;letter-spacing:-.02em}
        .offer-recap-sub{font-size:12px;color:rgba(255,255,255,.55);margin-top:4px;display:flex;flex-wrap:wrap;gap:10px}
        .offer-recap-sub span{display:flex;align-items:center;gap:4px}
        .rec-badge{
            font-size:10px;font-weight:700;letter-spacing:.04em;
            padding:3px 10px;border-radius:100px;
            background:rgba(255,255,255,.12);color:rgba(255,255,255,.8);
            margin-left:auto;flex-shrink:0;align-self:flex-start
        }

        /* FORM CARD */
        .form-card{background:var(--card);border:1px solid var(--border);border-radius:18px;overflow:hidden}
        .form-body{padding:2rem}
        .form-group{margin-bottom:1.6rem}
        .form-label{
            display:block;font-size:12px;font-weight:700;
            letter-spacing:.05em;text-transform:uppercase;
            color:var(--ink-2);margin-bottom:8px;display:flex;align-items:center;gap:6px
        }
        .opt-badge{font-size:10px;font-weight:700;letter-spacing:.04em;background:#F1EFE8;color:#7A7A7A;padding:2px 8px;border-radius:4px}
        .req-dot{width:6px;height:6px;border-radius:50%;background:var(--accent);display:inline-block}

        .f-textarea{
            width:100%;padding:12px 14px;
            border:1px solid var(--border);border-radius:10px;
            background:var(--surface);font-size:14px;color:var(--ink);
            font-family:'Instrument Sans',sans-serif;
            outline:none;resize:vertical;min-height:130px;line-height:1.6;
            transition:border-color .15s,box-shadow .15s
        }
        .f-textarea:focus{border-color:var(--ink);box-shadow:0 0 0 3px rgba(13,13,13,.06);background:#fff}
        .f-textarea::placeholder{color:#B4B2A9}
        .form-hint{font-size:11px;color:var(--ink-3);margin-top:5px;display:flex;align-items:center;gap:4px}

        /* FILE UPLOAD */
        .file-zone{
            border:2px dashed var(--border);border-radius:12px;
            padding:2rem 1.5rem;text-align:center;cursor:pointer;
            transition:border-color .15s,background .15s;
            position:relative;background:var(--surface)
        }
        .file-zone:hover,.file-zone.drag-over{border-color:var(--ink);background:#FAFAF8}
        .file-zone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
        .file-icon{width:44px;height:44px;border-radius:10px;background:var(--ink);display:grid;place-items:center;margin:0 auto 12px}
        .file-zone h4{font-size:14px;font-weight:700;font-family:'Syne',sans-serif;color:var(--ink);margin-bottom:5px}
        .file-zone p{font-size:12px;color:var(--ink-3)}
        .file-zone .file-chosen{
            display:none;align-items:center;gap:8px;
            background:var(--green-lt);border-radius:8px;
            padding:8px 14px;margin-top:12px;font-size:12px;
            font-weight:600;color:var(--green);
        }

        /* FOOTER */
        .form-footer{padding:1.4rem 2rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
        .btn-cancel{font-size:13px;font-weight:600;color:var(--ink-3);text-decoration:none;padding:10px 18px;border-radius:9px;border:1px solid var(--border);background:transparent;transition:all .15s;cursor:pointer;font-family:'Instrument Sans',sans-serif}
        .btn-cancel:hover{color:var(--ink);border-color:var(--ink)}
        .btn-submit{
            background:var(--ink);color:#fff;border:none;border-radius:9px;
            padding:11px 28px;font-size:13px;font-weight:700;
            font-family:'Syne',sans-serif;cursor:pointer;
            display:inline-flex;align-items:center;gap:7px;
            transition:background .15s,transform .1s
        }
        .btn-submit:hover{background:var(--accent);transform:translateY(-1px)}

        .error-msg{font-size:11px;color:var(--danger);margin-top:5px;display:flex;align-items:center;gap:4px}
    </style>

    <div class="form-wrap">

        {{-- OFFER RECAP --}}
        <div class="offer-recap">
            <div class="offer-recap-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.8)" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
            </div>
            <div style="flex:1;min-width:0">
                <div class="offer-recap-title">{{ $offer->title }}</div>
                <div class="offer-recap-sub">
                    <span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $offer->location }}
                    </span>
                    <span>{{ $offer->company_name }}</span>
                </div>
            </div>
            <span class="rec-badge">{{ $offer->contract_type }}</span>
        </div>

        {{-- FORM --}}
        <div class="form-card">
            <form action="{{ route('applications.store', $offer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                    {{-- COVER LETTER --}}
                    <div class="form-group">
                        <label class="form-label" for="cover_letter">
                            Lettre de motivation
                            <span class="opt-badge">OPTIONNEL</span>
                        </label>
                        <textarea id="cover_letter" name="cover_letter" class="f-textarea" placeholder="Expliquez pourquoi vous postulez, vos motivations, vos points forts pour ce poste...">{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                        <div class="form-hint">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Un message personnalisé augmente vos chances d'être remarqué.
                        </div>
                    </div>

                    {{-- CV UPLOAD --}}
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label" for="resume">
                            <span class="req-dot"></span>
                            Votre CV (PDF uniquement, max 2 Mo)
                        </label>
                        <div class="file-zone" id="file-zone">
                            <input type="file" id="resume" name="resume" accept=".pdf" required onchange="handleFile(this)">
                            <div class="file-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="12" y2="12"/><line x1="15" y1="15" x2="12" y2="12"/></svg>
                            </div>
                            <h4>Glissez votre CV ici</h4>
                            <p>ou cliquez pour sélectionner un fichier PDF</p>
                            <div class="file-chosen" id="file-chosen">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span id="file-name">—</span>
                            </div>
                        </div>
                        @error('resume')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Envoyer ma candidature
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function handleFile(input) {
            const chosen = document.getElementById('file-chosen');
            const name   = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                name.textContent = input.files[0].name;
                chosen.style.display = 'flex';
            }
        }
        const zone = document.getElementById('file-zone');
        zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('drag-over'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
        zone.addEventListener('drop',      e => { e.preventDefault(); zone.classList.remove('drag-over'); });
    </script>
</x-app-layout>