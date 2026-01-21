<?php
require_once __DIR__ . '/../Controller/BesoinEnsController.php';
?>
<section class="headerPages">
  <nav class="breadcrumb-besoins">
    <a href="besoins-objet-enseignants?page=accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">></span>
    <a href="besoins-objet-enseignants?page=espace-reprise" class="breadcrumbitem">Espace Reprise</a>
    <span class="breadcrumbseparator">></span>
    <span class="breadcrumbitem active">Besoins d'enseignants</span>
  </nav>
  <h1 class="breadcrumb_title">Besoins d’enseignants</h1>
</section>

<main class="main-content-besoins-enseignants">
  <form method="get" class="besoins-filter-bar">
    <input type="hidden" name="page" value="besoins-objet-enseignants" />
    <input type="text" name="search" placeholder="Rechercher..." value="<?= htmlspecialchars($search ?? '') ?>" class="besoins-search-box" />
    <select name="categorie" class="besoins-categorie-select">
      <option value="">Toutes catégories</option>
      <?php
      foreach ($cats as $cat)   
        echo '<option value="'.$cat['id_cat_obj'].'"'.($categorie == $cat['id_cat_obj'] ? ' selected' : '').'>'.htmlspecialchars($cat['nom_cat_obj']).'</option>';
      ?>
    </select>
    <button type="submit" class="besoins-search-btn">Filtrer</button>
  </form>
    
    <?php if (isset($_GET['success']) && $_GET['success'] === 'reponse'): ?>
        <div class="espace-notif-success">Votre réponse a bien été enregistrée !</div>
    <?php endif; ?>

  <?php if(empty($besoins)): ?>
    <div class="no-besoins-msg">Aucun besoin enseignant à afficher pour le moment.</div>
  <?php endif; ?>

  <div class="besoins-list">
    <?php foreach ($besoins as $besoin): ?>
        <?php
            $fullname = $besoin['nom_enseignant'] . (isset($besoin['pren_ut']) ? ' ' . $besoin['pren_ut'] : '');
            $imgUrl = "https://ui-avatars.com/api/?name=" . urlencode($fullname) . "&background=random";
        ?>
        <div class="besoin-card">
            <div class="besoin-card-header">
            <span class="besoin-card-ens">Enseignant concerné : <?= htmlspecialchars($besoin['nom_enseignant']) ?><?= isset($besoin['pren_ut']) ? ' ' . htmlspecialchars($besoin['pren_ut']) : '' ?></span>
            </div>
            <div class="besoin-card-main">
            <img src="<?= $imgUrl ?>" alt="Photo de l'objet" class="besoin-card-img"/>
            <div class="besoin-card-content">
                <strong class="besoin-card-titre"><?= htmlspecialchars($besoin['nom_demande_obj']) ?></strong>
                <div class="besoin-card-lieu"><?= htmlspecialchars($besoin['loca_demande_obj']) ?></div>
                <strong class="besoin-card-raison"> <?= htmlspecialchars($besoin['desc_demande_obj']) ?></strong>
                <form method="POST" action="traitement_besoinObjEnseignant" style="display:inline;">
                    <input type="hidden" name="id_demande_obj" value="<?= $besoin['id_demande_obj'] ?>">
                    <button type="submit" class="besoin-card-btn" onclick="return confirm('Voulez-vous vraiment valider et supprimer ce besoin ?');">Répondre à la demande</button>
                </form>

            </div>
            </div>
        </div>
    <?php endforeach; ?>

  </div>
  <div class="besoins-pagination">
    <?php for($i=1; $i<=$nbPages; $i++): ?>
        <a href="?page=besoins-objet-enseignants&num=<?= $i ?>&search=<?= urlencode($search) ?>&categorie=<?= urlencode($categorie) ?>"
            class="besoins-pagination-btn<?= ($page==$i?' active':'') ?>"><?= $i ?>
        </a>

    <?php endfor; ?>
  </div>
</main>
