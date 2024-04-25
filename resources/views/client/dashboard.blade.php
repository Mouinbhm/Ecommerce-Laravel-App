<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client</title>
</head>
<body>
    <h1>Dashboard client</h1>
    
    <!-- Bouton de déconnexion -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>

    <script>
        // Soumettre le formulaire de déconnexion lorsque le bouton est cliqué
        document.getElementById('logout-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher la soumission par défaut du formulaire
            this.submit(); // Soumettre le formulaire
        });
    </script>
</body>
</html>
