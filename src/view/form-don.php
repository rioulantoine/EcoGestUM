<?php
require_once __DIR__ . '/../Controller/formDonController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donner un objet - EcoGestUM</title>
    <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="connexion-page" style="background-image:url('<?php echo getenv('BASE_URL')."src/assets/Images/ConnexionImg.png"; ?>');">
    <div class="formDon-back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>espace-reprise'">
        <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2" width="36" height="36">
            <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
        <div class="formDon-container">
            <div class="formDon-logo">
                <img src="<?php echo getenv('BASE_URL')."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>
            <h2 class="formDon-title">FORMULAIRE DE DONATION</h2>
            <form class="formDon-form" method="POST" action="traitement_formDon" enctype="multipart/form-data">
                <div class="formDon-group" style="margin-bottom:24px;">
                    <label>Photos de l'objet :</label>
                    <label class="formDon-file-label">
                        <input type="file" name="photos[]" accept="image/jpeg, image/png" multiple required>
                        <span>Sélectionner des fichiers</span>
                    </label>
                    <small>Formats supportés : JPEG, PNG</small>
                </div>
                <div class="formDon-row" style="display:flex; gap:20px;">
                    <div class="formDon-group">
                        <label for="categorie">Catégorie de l'objet</label>
                        <select name="categorie" id="categorie" required>
                            <option value="">Choisir une catégorie</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id_cat_obj']; ?>">
                                    <?php echo htmlspecialchars($cat['nom_cat_obj']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="formDon-group">
                        <label for="nom">Nom de l'objet</label>
                        <input type="text" name="nom" id="nom" placeholder="Nom de l'objet" required>
                    </div>
                </div>
                <div class="formDon-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Description détaillée de l'objet" required></textarea>
                </div>
                <div class="formDon-row" style="display:flex; gap:20px;">
                    <div class="formDon-group">
                        <label for="localisation">Localisation</label>
                        <input type="text" name="localisation" id="localisation" placeholder="Lieu de dépôt (bâtiment, étage, etc.)" required>
                    </div>
                    <div class="formDon-group">
                        <label for="etat">État</label>
                        <select name="etat" id="etat" required>
                            <option value="">Choisir l'état</option>
                            <?php foreach($etats_objet as $etat): ?>
                                <option value="<?php echo $etat['id_etat_obj']; ?>">
                                    <?php echo htmlspecialchars($etat['nom_etat_obj']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if (!empty($error_message)): ?>
                    <div class="formDon-error">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($_GET['success'])): ?>
                    <div class="formDon-success">
                        Votre don a été enregistré avec succès !
                    </div>
                <?php endif; ?>
                <button type="submit" class="formDon-btn">CONFIRMER LE FORMULAIRE</button>
            </form>
        </div>
    </div>
</body>
</html>
