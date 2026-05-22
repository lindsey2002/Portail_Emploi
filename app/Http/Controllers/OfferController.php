<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    //
    public function create()
    {
        // si ce n'est pas un recruteur on le renvoie
        if(Auth::user()->role !== 'recruiter'){
            return redirect('/dashboard')->with('error', 'Accès réservé aux recruteurs.');
        }

        return view('offers.create');
    }

    public function store(Request $request)
    {
        if(Auth::user()->role !== 'recruiter'){
            return redirect('/dashboard')->with('error', 'Action non autorisée');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contract_type' => 'required|string',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
        ]);

        // Création de l'offre liée à l'utilisateur connecté
        Offer::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'contract_type' => $request->contract_type,
            'description' => $request->description,
            'salary' => $request->salary,
        ]);

        return redirect()->route('dashboard')->with('succès', 'Votre offre d\'emploie a bien été publiée');
    }

    public function index()
    {
        if(Auth::user()->role !== 'recruiter'){
            return redirect('/dashboard')->with('error', 'Accès réservé aux recruteurs.');
        }

        $myOffers = Offer::where('user_id', Auth::id())->latest()->get();

        return view('dashboard', compact('myOffers'));
    }

    public function showApplications($id)
    {
        if(Auth::user()->role !== 'recruiter'){
            return redirect('/dashboard')->with('error', 'Accès réservé aux recruteurs.');
        }

        $offer = Offer::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $applications = \App\Models\Application::with('user')->where('offer_id', $id)->latest()->get();

        return view('offers.applications', compact('offer', 'applications'));
    }
}
