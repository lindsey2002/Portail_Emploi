<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre candidature</title>
</head>
<body style="font-family: sans-serif; color: #333;">
    <h2>Bonjour {{ $application->user->name }},</h2>
    
    <p>Le recruteur a étudié votre candidature pour le poste de <strong>{{ $application->offer->title }}</strong>.</p>

    @if($application->status === 'accepte')
        <p style="color: #2563eb; font-weight: bold;">Bonne nouvelle ! Votre candidature a été acceptée.</p>
        <p>Le recruteur prendra contact avec vous très prochainement pour la suite du processus.</p>
    @else
        <p style="color: #dc2626; font-weight: bold;">Malheureusement, votre candidature n'a pas été retenue pour ce poste.</p>
        <p>Nous vous remercions pour l'intérêt que vous avez porté à notre entreprise et vous souhaitons une bonne continuation.</p>
    @endif

    <p>Cordialement,<br>L'équipe Recrutement</p>
</body>
</html>