<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ApplicationController;
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Si c'est un candidat, on récupère toutes les offres de la base de données
    if ($user->role === 'candidate') {
        $offers = App\Models\Offer::latest()->get();
        $applications = App\Models\Application::where('user_id', $user->id)
            ->with('offer')
            ->latest()
            ->get();

        return view('dashboard', compact('offers', 'applications'));
    }

    $myOffers = App\Models\Offer::where('user_id', $user->id)->latest()->get();
    $recruiterApplications = App\Models\Application::whereHas('offer', function ($query) use ($user) {
            $query->where('user_id', $user->id); 
        })
        ->with(['user', 'offer'])
        ->latest()
        ->get();

    // On retourne la vue dashboard avec les données du recruteur
    return view('dashboard', compact('myOffers', 'recruiterApplications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-offers/{offer}/applications', [OfferController::class, 'showApplications'])
    ->middleware('auth')
    ->name('offers.applications');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/{offer}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/offers/{offer}/apply', [ApplicationController::class, 'store'])->name('applications.store');
});

Route::patch('/applications/{application}/status/{status}', [ApplicationController::class, 'updateStatus'])
     ->name('applications.update-status');

Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

require __DIR__.'/auth.php';
