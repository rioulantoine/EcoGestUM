<?php
require_once __DIR__ . '/../Controller/SignalementController.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signaler un objet - EcoGestUM</title>
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
        <h2 class="formDon-title">FORMULAIRE DE SIGNALEMENT</h2>
        <form class="formDon-form" method="POST" action="traitement_signalement" enctype="multipart/form-data">
            <div class="formDon-group" style="margin-bottom:24px;">
                <label>Sélectionner un objet réservé :</label>
                <select name="idres" required>
                    <option value="">Choisir une réservation</option>
                    <?php foreach($reservations as $reservation): ?>
                        <option value="<?= htmlspecialchars($reservation['id_res']) ?>">
                            <?= htmlspecialchars($reservation['nom_obj_recycl']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="formDon-group">
                <label for="description">Description du problème</label>
                <textarea name="description" id="description" rows="4" placeholder="Décrivez le problème de l'objet" required></textarea>
            </div>
            <div class="formDon-group" style="margin-bottom:20px">
                <label>Photo du signalement :</label>
                <label class="formDon-file-label">
                    <input type="file" name="photos[]" accept="image/jpeg, image/png" multiple required>
                    <span>Sélectionner un fichier</span>
                </label>
                <small>Format : JPEG, PNG</small>
            </div>
            <?php if (!empty($error_message)): ?>
                <div class="formDon-error">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($_GET['success']) && $_GET['success'] === 'signalement'): ?>
                <div class="formDon-success">
                    Signalement transmis avec succès !
                </div>
            <?php endif; ?>
            <button type="submit" class="formDon-btn">CONFIRMER LE SIGNALEMENT</button>
        </form>
    </div>
</div>
</body>
</html>
