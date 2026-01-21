<?php
require_once __DIR__ . '/../Controller/ProfilController.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet">
    <title>Profil - EcoGestUM</title>
</head>
<body>
<div class="profil-page" style="background-image:url('<?= getenv('BASE_URL'); ?>src/assets/Images/ConnexionImg.png');">
    <div class="back-arrow" onclick="window.location.href='<?= getenv('BASE_URL'); ?>accueil'">
        <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="profil-container">
        <!-- HEADER -->
        <div class="profil-header-bar">
            <div class="profil-header-left">
                <button class="profil-header-arrow" onclick="window.location.href='<?= getenv('BASE_URL'); ?>accueil'">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div>
                    <div class="profil-header-title">Bienvenue, <?= htmlspecialchars($user['pren_ut']) ?></div>
                    <div class="profil-header-id">n°<?= htmlspecialchars($user['id_ut']) ?></div>
                </div>
            </div>
            <img src="<?= getenv('BASE_URL'); ?>src/assets/Images/logo_LEMANS_UNIVERSITE_Blanc.png"
                 class="profil-header-logo" alt="Logo LMU">
        </div>
        <!-- PROFIL -> MAIN CARD -->
        <div class="profil-main-card">
            <div class="profil-info-align">
                <img src="<?= getenv('BASE_URL'); ?>src/assets/Images/user_icon.png"
                     class="profil-avatar" alt="Avatar">
                <div>
                    <div class="profil-nom">
                        <?= htmlspecialchars($user['pren_ut'])." ".htmlspecialchars($user['nom_ut']); ?>
                    </div>
                    <div class="profil-email"><?= htmlspecialchars($user['email_ut']); ?></div>
                    <div class="profil-fonction"><?= htmlspecialchars($user['nom_comp'] ?? ''); ?></div>
                </div>
            </div>

            <!-- Formulaire modification de l'email -->
            <?php if ($error_message): ?>
                <div class="profil-error"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <div class="profil-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>
            <form class="profil-champs-table" method="POST" action="">
                <div class="profil-champs-full">
                    <label class="profil-label-email">E-mail personnel</label>
                    <div class="profil-champs-inline">
                    <input type="email" name="new_email" value="<?= htmlspecialchars($user['email_ut']); ?>" required>
                    <button type="submit" class="profil-btn-modif">Modifier</button>
                    </div>
                </div>
            </form>
            <!-- AFFECTATION -->
            <div class="profil-affectation-card">
                <div class="profil-aff-title">État de votre(vos) affectation(s)</div>
                <div class="profil-aff-list">
                    <div>
                        <div><span class="profil-label">Université</span></div>
                        <span><?= htmlspecialchars($user['nom_univ'] ?? ''); ?></span>
                    </div>
                    <div>
                        <div><span class="profil-label">Composante</span></div>
                        <span><?= htmlspecialchars($user['nom_comp'] ?? ''); ?></span>
                    </div>
                    <div>
                        <div><span class="profil-label">Département</span></div>
                        <span><?= htmlspecialchars($user['nom_dept'] ?? ''); ?></span>
                    </div>
                </div>
            </div>
            <button class="profil-btn-deconnexion-v2" onclick="window.location.href='<?= getenv('BASE_URL'); ?>deconnexion'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4250af" stroke-width="2" style="margin-right:8px;">
                    <path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Se déconnecter
            </button>
        </div>
    </div>
</div>
</body>
</html>
