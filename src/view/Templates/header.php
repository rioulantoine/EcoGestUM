<?php
require_once __DIR__ . '/../../Controller/HeaderController.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo getenv('BASE_URL') . "src/assets/css/style.css"; ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <title>EcoGestUM</title>
</head>
<body>
    <header class="header">
        <!-- Top bar -->
        <div class="header_top">
            <div id="logo_accueil" class="header_logo">
                <div class="LogoAcceuil">
                    <img src="<?php echo getenv('BASE_URL') . "src/assets/Images/logo_LEMANS_UNIVERSITE_Blanc.png"; ?>" alt="Le Mans Université" width="90" height="40">
                </div>
                <span class="header_separator">|</span>
                <span class="header_site-name">EcoGestUM</span>
            </div>

            <?php if (!empty($_SESSION['isConnected']) && $_SESSION['isConnected'] === true): ?>
                <!-- Utilisateur connecté -->
                <div class="header_right">
                    <?php if (get_nom_role($_SESSION['user']['roles'][0]) == 'Présidence' || get_nom_role($_SESSION['user']['roles'][0]) == 'Chef de département'): ?>
                        <div id="dashbord">
                            <button class="button-dashboard">
                                <a href="<?php echo getenv('BASE_URL'); ?>dashboard">DASHBOARD</a>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div id="notifications">
                        <img src="<?php echo getenv('BASE_URL'); ?>src/assets/Images/alerte.png" alt="Notifications" class="alerte-icon" title="Icon Alerte">
                    </div>
                    <div id="profil">
                        <img src="<?php echo getenv('BASE_URL'); ?>src/assets/Images/user_icon.png" alt="Utilisateur" class="header-user-icon" title="Icon User">
                    </div>
                </div>
            <?php else: ?>
                <!-- Utilisateur non connecté -->
                <a href="<?php echo getenv('BASE_URL'); ?>connexion">
                    <button class="header_connect-btn">SE CONNECTER</button>
                </a>
            <?php endif; ?>
        </div>

        <!-- Navigation principale -->
        <nav class="header_nav">
            <div class="nav">
                <div class="nav_item <?php if ($page == 'statistiques') { echo 'active'; } ?>">
                    <a href="<?php echo getenv('BASE_URL'); ?>statistiques" class="nav_link">
                        <svg class="nav_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 17V9M13 17v-5M8 17v-3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav_text">Statistiques</span>
                    </a>
                </div>

                <div class="nav_item <?php if ($page == 'notre-politique') { echo 'active'; } ?>">
                    <a href="<?php echo getenv('BASE_URL'); ?>notre-politique" class="nav_link">
                        <svg class="nav_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="17 21 17 13 7 13 7 21" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="7 3 7 8 15 8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav_text">Notre politique</span>
                    </a>
                </div>

                <div class="nav_item <?php if ($page == 'espace-reprise') { echo 'active'; } ?>">
                    <a href="<?php echo $redirect_espace_reprise; ?>" class="nav_link">
                        <svg class="nav_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav_text">Espace Reprise</span>
                    </a>
                </div>

                <div class="nav_item <?php if ($page == 'evenements') { echo 'active'; } ?>">
                    <a href="<?php echo $redirect_evenements; ?>" class="nav_link">
                        <svg class="nav_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="16" y1="2" x2="16" y2="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="8" y1="2" x2="8" y2="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="3" y1="10" x2="21" y2="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav_text">Évènements</span>
                    </a>
                </div>

                <div class="nav_item <?php if ($page == 'messagerie') { echo 'active'; } ?>">
                    <a href="<?php echo $redirect_messagerie; ?>" class="nav_link">
                        <svg class="nav_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav_text">Messagerie</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <script>
        const BASE_URL = '<?php echo getenv('BASE_URL'); ?>';
    </script>

    <script src ="<?php echo getenv('BASE_URL'); ?>src/assets/js/Header.js"></script>
