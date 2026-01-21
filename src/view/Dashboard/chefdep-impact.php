<?php
require_once __DIR__ . '/../../Controller/ImpactDepController.php';
?>

<div class="impact-stats-container">
  <!-- Cartes résumé en haut -->
  <section class="stats-summary">
    <div class="stats-card stats-black-card impact-materials">
      <span class="stats-value">5Kg</span>
      <span class="stats-label">de matériaux recyclés<br>depuis 2020</span>
    </div>
    <div class="stats-card stats-orange-card objects-recycled">
      <span class="stats-value"><?php echo $nb_objets_recycles; ?></span>
      <span class="stats-label">objets recyclés<br>grâce à EcoGestUM</span>
    </div>
    <div class="stats-card stats-blue-card economics-saved">
      <span class="stats-value">100&nbsp;€</span>
      <span class="stats-label">économisé avec<br>la reprise d’objets</span>
    </div>
    <div class="stats-card stats-grey-card reuse-rate">
      <span class="stats-value">91%</span>
      <span class="stats-label">de taux de<br>réutilisation</span>
    </div>
  </section>

  <!-- Détails : recyclage par catégorie, donateurs, objets reçus -->
  <section class="stats-details">
    <div class="stats-category-recycling">
      <span class="category-title">RECYCLAGE PAR CATÉGORIE</span>
      <ul class="category-list">
        <?php foreach ($data as $item): ?>
          <li class="cat-item <?php echo strtolower(str_replace([' ', 'é'], ['-', 'e'], $item['nom_cat_obj'])); ?>">
            <?php echo htmlspecialchars($item['nom_cat_obj']); ?>
            <span class="cat-count"><?php echo number_format($item['nombre'], 0, ' ', ' '); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="recycle-piechart">
        <canvas id="repartitionChart"></canvas>
      </div>
    </div>
    <div class="stats-details-part">
      <div class="stats-card stats-white-card stats-donors">
        <span class="donors-title">NOMBRE DE DONATEURS DU DÉPARTEMENT</span>
        <span class="donors-count"><?php echo isset($nb_donateurs) ? $nb_donateurs : '-'; ?></span>
      </div>
      <div class="stats-card stats-white-card stats-received-objects">
        <span class="received-title">OBJETS REÇUS</span>
        <span class="received-count"><?php echo $nb_objets_recycles; ?></span>
        <span class="received-subtext">- <?php echo max(0, $nb_objets_recycles - 1); ?> objets réinsérés en service</span>
      </div>
      <div class="stats-monthly-objects">
        <span class="month-title"><?php echo getNomMois($mois); ?> <?php echo $annee; ?></span>
        <span class="month-value"><?php echo $nb_nouv_obj; ?></span>
        <span class="month-label">Nouveaux objets</span>
        <span class="month-desc">En <?php echo getNomMois($mois); ?> <?php echo $annee; ?>, <?php echo $nb_nouv_obj; ?> nouveaux objets ont été enregistrés<br>dans le département</span>
      </div>
    </div>
  </section>
</div>

<!-- Data pour JS ChefDep.js -->
<script>
  window.dashboardData = {
    repartition: <?php echo json_encode($data); ?>,
    mois: <?php echo (int)$mois; ?>,
    annee: <?php echo (int)$annee; ?>
  };
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo getenv('BASE_URL'); ?>src/assets/js/ChefDep.js"></script>
