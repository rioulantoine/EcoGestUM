<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
    <title>Mot de passe oublié - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo getenv("BASE_URL")."src/assets/Images/ConnexionImg.png"; ?>');">
        <div class="back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>connexion'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="connexion-container">
            <div class="connexion-logo">
                <img src="<?php echo getenv("BASE_URL")."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>
            <form class="connexion-form" method="POST" action="traitement_mdp_oublie.php">
                <h2 class="connexion-title">Réinitialisation du mot de passe</h2>
                <div class="form-group">
                    <label for="identifiant">Identifiant (login) LMU *</label>
                    <input type="text" id="identifiant" name="identifiant" required placeholder="Votre identifiant LMU">
                </div>
                <div class="form-group">
                    <label for="email_securite">Adresse mail de secours *</label>
                    <input type="email" id="email_securite" name="email_securite" required placeholder="Votre adresse mail personnelle">
                </div>
                <div class="notice">
                    L’adresse à fournir est votre email personnel communiqué à l’administration, pas celui de l’Université. En cas d’oubli ou d’adresse invalide, contactez votre scolarité (étudiants) ou votre RH (personnels).
                </div>
                <button type="submit" class="connexion-btn">Valider</button>
                <div class="connexion-footer">
                    <a href="connexion.php">Connexion</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
