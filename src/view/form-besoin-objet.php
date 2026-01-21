<?php 
require_once __DIR__ . '/../Controller/FormBesoinController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'objet - Le Mans Université</title>
    <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="besoin-page-bg" style="background-image:url('<?php echo getenv('BASE_URL')."src/assets/Images/ConnexionImg.png"; ?>');">
        <div class="besoin-back-btn" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>espace-reprise'">
            <!-- flèche retour -->
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2" width="36" height="36">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="besoin-form-wrapper">
            <div class="besoin-logo">
                <img src="<?php echo getenv('BASE_URL')."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>
            <h2 class="besoin-title">DEMANDE D'UN BESOIN MATERIEL</h2>
            <form class="besoin-form" method="POST" action="traitement_form-besoin-objet">
                <div class="besoin-field">
                    <label for="categorie_besoin">Catégorie de l'objet</label>
                    <select name="categorie_besoin" id="categorie_besoin" required>
                        <option value="">Choisir une catégorie</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id_cat_obj']; ?>">
                                <?php echo htmlspecialchars($cat['nom_cat_obj']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="besoin-field">
                    <label for="raison_besoin">Raison de la demande</label>
                    <input type="text" name="raison_besoin" id="raison_besoin" placeholder="Ex: Utilisation pédagogique" required>
                </div>
                <div class="besoin-field">
                    <label for="nom_besoin">Nom de l'objet</label>
                    <input type="text" name="nom_besoin" id="nom_besoin" placeholder="Nom de l'objet" required>
                </div>
                <div class="besoin-field">
                    <label for="description_besoin">Description</label>
                    <textarea name="description_besoin" id="description_besoin" rows="3" placeholder="Description détaillée" required></textarea>
                </div>
                <div class="besoin-field">
                    <label for="localisation_besoin">Localisation</label>
                    <input type="text" name="localisation_besoin" id="localisation_besoin" placeholder="Lieu (bâtiment, étage, etc.)" required>
                </div>
                <button type="submit" class="besoin-submit-btn">CONFIRMER LE FORMULAIRE</button>
            </form>
        </div>
    </div>
</body>
</html>
