<?php 
require_once __DIR__ . '/../../Controller/PresAcceuilController.php';
?>

<div class="dashboard-main-content">
    <div class="dashboard-top">
        <!-- Navigation mois -->
        <div class="timeline-nav-container">
            <button class="timeline-nav prev" onclick="changerMois(-1)">
                ‹ <?php echo getNomMois($mois - 1 ?: 12); ?> <?php echo ($mois == 1) ? $annee - 1 : $annee; ?>
            </button>
            
            <button class="timeline-nav next" onclick="changerMois(1)">
                <?php echo getNomMois($mois + 1 > 12 ? 1 : $mois + 1); ?> 
                <?php echo ($mois == 12) ? $annee + 1 : $annee; ?> ›
            </button>
        </div>

        <!-- Statistiques principales -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon red">
                    <span class="stat-number"><?php echo $nb_nouv_obj; ?></span>
                </div>
                <div class="stat-title">Nouveaux objets</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, 
                    <?php echo $nb_nouv_obj; ?> nouveaux objets ont été 
                    enregistrés sur ce service pour être réutilisés.
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon blue">
                    <span class="stat-number"><?php echo $nb_obj_recycles; ?></span>
                </div>
                <div class="stat-title">Objets recyclés</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, 
                    <?php echo $nb_obj_recycles; ?> objets ont été pris 
                    pour être réutilisés.
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">
                    <span class="stat-number"><?php echo $nb_events; ?></span>
                </div>
                <div class="stat-title">Événements sur le recyclage</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, 
                    <?php echo $nb_events; ?> événement(s) ont été organisés pour sensibiliser les étudiants.
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers rapports -->
    <div class="dashboard-rapports">
        <div class="rapports-title">VOS DERNIERS RAPPORTS</div>
        <div class="rapports-list-cols">
            <a href="files/rapport_trim1.pdf" class="rapport-item" download>
                Rapport statistiques trim1.pdf
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                    <path d="M24.1938 13.125H21.8751V5.83333C21.8751 5.03125 21.2188 4.375 20.4167 4.375H14.5834C13.7813 4.375 13.1251 5.03125 13.1251 5.83333V13.125H10.8063C9.50841 13.125 8.85216 14.7 9.77091 15.6187L16.4647 22.3125C17.0334 22.8812 17.9522 22.8812 18.5209 22.3125L25.2147 15.6187C26.1334 14.7 25.4917 13.125 24.1938 13.125ZM7.29175 27.7083C7.29175 28.5104 7.948 29.1667 8.75008 29.1667H26.2501C27.0522 29.1667 27.7084 28.5104 27.7084 27.7083C27.7084 26.9062 27.0522 26.25 26.2501 26.25H8.75008C7.948 26.25 7.29175 26.9062 7.29175 27.7083Z" fill="#ffffff"/>
                </svg>
            </a>
            <a href="files/rapport_trim2.pdf" class="rapport-item" download>
                Rapport statistiques trim2.pdf
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                    <path d="M24.1938 13.125H21.8751V5.83333C21.8751 5.03125 21.2188 4.375 20.4167 4.375H14.5834C13.7813 4.375 13.1251 5.03125 13.1251 5.83333V13.125H10.8063C9.50841 13.125 8.85216 14.7 9.77091 15.6187L16.4647 22.3125C17.0334 22.8812 17.9522 22.8812 18.5209 22.3125L25.2147 15.6187C26.1334 14.7 25.4917 13.125 24.1938 13.125ZM7.29175 27.7083C7.29175 28.5104 7.948 29.1667 8.75008 29.1667H26.2501C27.0522 29.1667 27.7084 28.5104 27.7084 27.7083C27.7084 26.9062 27.0522 26.25 26.2501 26.25H8.75008C7.948 26.25 7.29175 26.9062 7.29175 27.7083Z" fill="#ffffff"/>
                </svg>
            </a>
            <a href="files/rapport_sem2.pdf" class="rapport-item" download>
                Rapport statistiques sem2.pdf
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                    <path d="M24.1938 13.125H21.8751V5.83333C21.8751 5.03125 21.2188 4.375 20.4167 4.375H14.5834C13.7813 4.375 13.1251 5.03125 13.1251 5.83333V13.125H10.8063C9.50841 13.125 8.85216 14.7 9.77091 15.6187L16.4647 22.3125C17.0334 22.8812 17.9522 22.8812 18.5209 22.3125L25.2147 15.6187C26.1334 14.7 25.4917 13.125 24.1938 13.125ZM7.29175 27.7083C7.29175 28.5104 7.948 29.1667 8.75008 29.1667H26.2501C27.0522 29.1667 27.7084 28.5104 27.7084 27.7083C27.7084 26.9062 27.0522 26.25 26.2501 26.25H8.75008C7.948 26.25 7.29175 26.9062 7.29175 27.7083Z" fill="#ffffff"/>
                </svg>
            </a>
            <a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=rapport" class="dashboard-btn-gen">
                <div class="dashboard-btn-gen-title">Générer un rapport</div>
            </a>
        </div>
    </div>
    <!-- Bas de page du dashboard -->
    <div class="dashboard-bas">
        <div class="dashboard-card">
            <div class="card-title">Meilleur mois de recyclage</div>
            <div class="card-desc">
                <strong>MARS</strong> avec 400 objets recyclables récupérés
            </div>
            <a class="dashboard-btn best-stat" href="<?php echo getenv('BASE_URL'); ?>dashboard?section=impact">
                Statistiques
            </a>
        </div>

        <div class="dashboard-card card-comm">
            <div class="card-title comm-title">Communications officielles</div>
            <div class="card-desc comm-desc">
                Envoyez des actualités, rapports, campagnes de sensibilisation
            </div>
            <a class="dashboard-btn comm-btn" href="<?php echo getenv('BASE_URL'); ?>dashboard?section=communication">
                Communication
            </a>
        </div>
    </div>
</div>

<!-- Injection des données PHP pour le JS -->
<script>
    window.dashboardData = {
        repartition: <?php echo json_encode($repartition); ?>,
        mois: <?php echo $mois; ?>,
        annee: <?php echo $annee; ?>
    };
</script>

<!-- Chargement des scripts -->
<script src="<?php echo getenv('BASE_URL'); ?>src/assets/js/Presidence.js"></script>
