<?php 
require_once __DIR__ . '/../../Controller/ChefDepAcceuilController.php';
?>
<div class="dashboard-main-content">
    <div class="dashboard-top">
        <div class="timeline-nav-container">
            <button class="timeline-nav prev" onclick="changerMois(-1)">
                ‹ <?php echo getNomMois($mois - 1 ?: 12); ?> <?php echo ($mois == 1) ? $annee - 1 : $annee; ?>
            </button>
            
            <button class="timeline-nav next" onclick="changerMois(1)">
                <?php echo getNomMois($mois + 1 > 12 ? 1 : $mois + 1); ?> 
                <?php echo ($mois == 12) ? $annee + 1 : $annee; ?> ›
            </button>
        </div>
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon red">
                    <span class="stat-number"><?php echo $stats_mois_actuel['nouveaux_objets']; ?></span>
                </div>
                <div class="stat-title">Nouveaux objets</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, 
                    <?php echo $stats_mois_actuel['nouveaux_objets']; ?> nouveaux objets ont été 
                    enregistrés sur ce service pour être réutilisés.
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon blue">
                    <span class="stat-number"><?php echo $stats_mois_actuel['objets_recycles']; ?></span>
                </div>
                <div class="stat-title">Objets recyclés</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, 
                    <?php echo $stats_mois_actuel['objets_recycles']; ?> objets ont été pris 
                    pour être réutilisés par le département.
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">
                    <span class="stat-number"><?php echo $stats_mois_actuel['evenements']; ?></span>
                </div>
                <div class="stat-title">Événements sur le recyclage</div>
                <div class="stat-desc">
                    En <?php echo $nom_mois; ?> <?php echo $annee; ?>, le département a organisé 
                    <?php echo $stats_mois_actuel['evenements']; ?> événement(s) pour sensibiliser les étudiants.
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-middle">
        <div class="repartition-section">
            <h2 class="section-title-dark">Répartition des objets</h2>
            <div class="repartition-container">
                <div class="chart-container">
                    <canvas id="repartitionChart"></canvas>
                </div>
                <div class="chart-legend">
                    <?php foreach($repartition as $index => $categorie): ?>
                    <div class="legend-item" data-color="<?php echo $index; ?>">
                        <span class="legend-bullet"></span>
                        <span class="legend-label"><?php echo htmlspecialchars($categorie['nom_cat_obj']); ?></span>
                        <span class="legend-value"><?php echo $categorie['nombre']; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="impact-card">
            <div class="impact-number"><?php echo get_nb_objets_reserves(); ?></div>
            <div class="impact-text">
                objets recyclés au sein de l'université du Mans depuis le lancement de la plateforme EcoGestUM
            </div>
            <a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=impact" class="dashboard-btn btn-impact">
                Statistiques et impact
            </a>
        </div>
    </div>
<div class="dashboard-bas">
    <div class="dashboard-card">
        <div class="card-title">Voir les opérations de recyclage du département</div>
        <a class="dashboard-btn best-stat" href="<?php echo getenv('BASE_URL'); ?>dashboard?section=historique">
            Historique
        </a>
    </div>

    <div class="dashboard-card card-comm">
        <div class="card-title comm-title">Voir les communications récentes du département</div>
        <a class="dashboard-btn comm-btn" href="<?php echo getenv('BASE_URL'); ?>dashboard?section=communication">
            Communication
        </a>
    </div>
</div>


<!-- Script Chart.js -->
 <script>
    window.dashboardData = {
        repartition: <?php echo json_encode($repartition); ?>,
        mois: <?php echo $mois; ?>,
        annee: <?php echo $annee; ?>
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo getenv('BASE_URL'); ?>src/assets/js/ChefDep.js"></script>
