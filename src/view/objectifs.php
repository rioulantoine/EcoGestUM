<?php 
require_once __DIR__ . '/../Controller/ObjectifsUnivController.php';
?>
<section class="headerPages"> 
    <nav class="breadcrumb">
        <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
        <span class="breadcrumbseparator">></span>
        <a href="<?php echo getenv('BASE_URL'); ?>notre-politique" class="breadcrumbitem">Notre politique</a>
        <span class="breadcrumbseparator">></span>
        <span class="breadcrumbitem active">Objectifs du moments</span>
    </nav>
    <h1 class="breadcrumb_title">Objectifs</h1>
</section>
<div class="objectifs-container">
<?php foreach ($objectifs as $objectif): ?>
  <div class="objectif-card objectif-<?php echo strtolower(str_replace([' ', 'é'], ['-', 'e'], $objectif['statut'])); ?>">
    <h2 class="objectif-title">
      <?php echo htmlspecialchars($objectif['nom_objectif']); ?>
    </h2>
    <p class="objectif-desc">
      <?php echo nl2br(htmlspecialchars($objectif['desc_objectif'])); ?>
    </p>
    <div class="objectif-progress-label">
      État : <span class="etat-label"><?php echo ucfirst($objectif['statut']); ?></span>
    </div>
  </div>
<?php endforeach; ?>
</div>

