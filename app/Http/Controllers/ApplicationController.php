<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function create($offerId)
    {
        // Sécurité : Un recruteur ne doit pas postuler à une offre
        if (Auth::user()->role !== 'candidate') {
            return redirect('/dashboard')->with('error', 'Seuls les candidats peuvent postuler aux offres.');
        }

        $offer = Offer::findOrFail($offerId);
        return view('applications.create', compact('offer'));
    }

    public function store(Request $request, $offerId)
    {
        if (Auth::user()->role !== 'candidate') {
            return redirect('/dashboard')->with('error', 'Action non autorisée.');
        }

        // Validation stricte du fichier (PDF requis, max 2Mo)
        $request->validate([
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf|max:2048', 
        ]);

        // Gestion de l'upload du fichier dans le dossier storage/app/public/resumes
        $offer = Offer::findOrFail($offerId);
        $path = $request->file('resume')->store('resumes', 'public');

        $score = 20; // Score de base pour l'effort
    
        if ($request->filled('cover_letter')) {
            $cleanText = function($text) {
                $text = mb_strtolower($text, 'UTF-8');
                $utf8 = [
                    '/[áàâãäåæ]/u' => 'a', '/[éèêë]/u' => 'e', '/[íìîï]/u' => 'i',
                    '/[óòôõöø]/u' => 'o', '/[úùûü]/u' => 'u', '/[ç]/u' => 'c'
                ];
                $text = preg_replace(array_keys($utf8), array_values($utf8), $text);
                return str_replace(["'", ".", ",", "-", "\"", "(", ")"], " ", $text);
            };

            $letterCleaned = $cleanText($request->cover_letter);
            $titleCleaned = $cleanText($offer->title);

            // On sépare tous les mots du titre
            $titleWords = array_filter(explode(' ', $titleCleaned));
            
            $matches = 0;
            $wordsCounted = 0;

            foreach ($titleWords as $word) {
                $word = trim($word);
                // On ne garde que les vrais mots significatifs du métier (ex: "commercial", "terrain")
                if (mb_strlen($word, 'UTF-8') > 3) {
                    $wordsCounted++;
                    // On utilise trim pour être sûr de chercher le mot brut
                    if (str_contains($letterCleaned, $word)) {
                        $matches++;
                    }
                }
            }
            
            if ($wordsCounted > 0) {
                // Si le candidat a trouvé TOUS les mots -> 100%
                // S'il a trouvé au moins un mot principal (ex: "commercial") -> on lui met un gros bonus d'au moins 70%
                if ($matches == $wordsCounted) {
                    $score = 100;
                } elseif ($matches > 0) {
                    $score = 75; // Score de profil idéal direct !
                } else {
                    $score = 25; // Faible correspondance
                }
            } else {
                if (str_contains($letterCleaned, $titleCleaned)) {
                    $score = 100;
                }
            }
        }

        // --- APPORT CORRECTIF : ENREGISTREMENT EN BDD ---
        Application::create([
            'offer_id' => $offerId,
            'user_id' => Auth::id(),
            'match_score' => $score,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $path,
        ]);
        // ------------------------------------------------

        return redirect()->route('dashboard')->with('success', 'Votre candidature a été transmise avec succès !');
    }
}