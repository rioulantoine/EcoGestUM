<?php 
require_once __DIR__ . '/../Controller/EvenementController.php';
?>
<section class="headerPages">
  <nav class="breadcrumb">
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">&gt;</span>
    <span class="breadcrumbitem active">Événements</span>
  </nav>
  <h1 class="breadcrumb_title">Nos événements</h1>
</section>

<main class="main-content">
  <div class="enroll-summary-box">
    <h1 class="enroll-summary-title">VOS INSCRIPTIONS</h1>
    <p class="enroll-summary-desc">Retrouvez vos inscriptions aux évènements sur cette page :</p>
    <a href="mesInscriptions" class="enroll-summary-btn">Vos inscriptions</a>
</div>
<?php if ($message): ?>
    <div class="message-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

  <div class="events-grid">
    <?php $imgIndex = 1; foreach ($events as $event): ?>
      <div class="event-card">
        <img src="src/assets/Images/pic0<?php echo $imgIndex; ?>.jpg"
             alt="Image évènement <?php echo htmlspecialchars($event['nom_event']); ?>"
             class="event-img">
        <div class="event-content">
          <div class="event-title"><?php echo htmlspecialchars($event['nom_event']); ?></div>
          <div class="event-desc"><?php echo htmlspecialchars($event['desc_event']); ?></div>
          <div class="event-footer">
            <span class="event-price">
              <?php echo ($event['prix_event'] == 0) ? "Gratuit" : htmlspecialchars($event['prix_event']) . "€"; ?>
            </span>
            <span class="event-date"><?php echo htmlspecialchars($event['date_event']); ?></span>
            <form method="post" class="event-inscription-form">
              <input type="hidden" name="id_event" value="<?php echo htmlspecialchars($event['id_event']); ?>">
              <button type="submit" name="inscrire_event" class="event-btn">S’inscrire</button>
            </form>
          </div>
        </div>
      </div>
      <?php $imgIndex = ($imgIndex % 6) + 1; ?>
    <?php endforeach; ?>
  </div>
</main>

