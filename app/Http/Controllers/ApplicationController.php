<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Application;

class ApplicationController extends Controller
{
    //
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
        $path = $request->file('resume')->store('resumes', 'public');

        // Enregistrement en base de données
        Application::create([
            'offer_id' => $offerId,
            'user_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'resume_path' => $path, // On sauvegarde le chemin d'accès du fichier
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre candidature a été transmise avec succès !');
    }
}
