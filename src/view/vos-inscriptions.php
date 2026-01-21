<?php 
require_once __DIR__ . '/../Controller/InscriptionEventController.php';
?>
<section class="headerPages">
  <nav class="breadcrumb">
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">&gt;</span>
    <a href="<?php echo getenv('BASE_URL'); ?>evenements" class="breadcrumbitem">Evénements</a>
    <span class="breadcrumbseparator">&gt;</span>
    <span class="breadcrumbitem active">Mes inscriptions</span>
  </nav>
  <h1 class="breadcrumb_title">Mes inscriptions</h1>
</section>
<main class="main-content">
  <?php if ($message): ?>
    <div class="message-success"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>
  <section class="reservation-cards">
    <?php
      if (empty($userEvents)) {
        echo "<p class='res-empty'>Aucune inscription à un événement pour le moment.</p>";
      } else {
        $imgIndex = 1;
        foreach ($userEvents as $ev) {
    ?>
    <div class="reservation-card">
      <img class="reservation-img" src="src/assets/Images/pic0<?php echo $imgIndex;?>.jpg" alt="<?php echo htmlspecialchars($ev['nom_event']); ?>">
      <div class="reservation-info">
        <h2 class="reservation-title"><?php echo htmlspecialchars($ev['nom_event']); ?></h2>
        <?php if (!empty($ev['desc_event'])): ?>
          <div class="reservation-attr"><?php echo htmlspecialchars($ev['desc_event']); ?></div>
        <?php endif; ?>
        <?php if (!empty($ev['lieu_event'])): ?>
          <div class="reservation-attr">Lieu : <?php echo htmlspecialchars($ev['lieu_event']); ?></div>
        <?php endif; ?>
        <div class="reservation-attr">
          Date : <?php echo htmlspecialchars(date('d M Y', strtotime($ev['date_event']))); ?>
        </div>
        <div class="reservation-attr">
          Prix : <span style="color:#D4451B;font-weight:600;"><?php echo ($ev['prix_event'] == 0) ? 'Gratuit' : htmlspecialchars($ev['prix_event']) . "€"; ?></span>
        </div>
      </div>
      <form method="post" class="btns-res-row">
  <input type="hidden" name="id_event" value="<?php echo htmlspecialchars($ev['id_event']); ?>">
  <button type="submit" name="annuler_event" class="btn-annuler-res">Annuler mon inscription</button>
</form>

    </div>
    <?php
        $imgIndex = ($imgIndex % 6) + 1;
        }
      }
    ?>
  </section>
</main>
